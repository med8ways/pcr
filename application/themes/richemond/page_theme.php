<?php

namespace  Application\Theme\Richemond;

use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use Concrete\Core\Multilingual\Page\Section\Section;
use Concrete\Core\Page\Theme\Theme;
use Concrete\Core\Entity\Block\BlockType\BlockType;
use Concrete\Core\Area\Area;
use Concrete\Core\Page\Page;
use Concrete\Core\Cache\CacheLocal;
use Concrete\Core\Page\PageList;
use Concrete\Core\Tree\Node\Type\Topic;
use Concrete\Core\Express\EntryList;
use Concrete\Core\Entity\File\File;
use Concrete\Core\File\Image\Thumbnail\Type\Type;

class PageTheme extends Theme implements ThemeProviderInterface
{
    /**
     * @var string
     */
    protected $languageCode;

    /**
     * @var string
     */
    protected $pageListPagination;

    public function getThemeAreaLayoutPresets()
    {
        //TODO
    }

    public function getThemeName()
    {
        return 'Richemond';
    }

    public function getThemeHandle()
    {
        return 'richemond';
    }

    public function registerAssets()
    {
        $u = new \User();
        $adminGroup = \Concrete\Core\User\Group\Group::getByName('Administrators');
        $isAdministrator = ($u->inGroup($adminGroup) || $u->isSuperUser());

        if (!$isAdministrator) {
            $this->providesAsset('javascript', 'jquery');
            $this->providesAsset('css', 'core/frontend/errors');
        }

        $this->providesAsset('css', 'blocks/form');
    }

    /**
     * @return array
     */
    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Span'), 'menuClass' => '', 'spanClass' => '', 'forceBlock' => '0'),
        );
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        if ($this->languageCode == null) {
            $this->languageCode = Section::getCurrentSection()->getLanguage();
        }

        return $this->languageCode;
    }

    /**
     * @param integer $pageID
     *
     * @return integer
     */
    public function getPageIDInBaseLocale($pageID)
    {
        $locale = \Config::get('concrete.base_locale');
        $relatedPageID = Section::getRelatedCollectionIDForLocale($pageID, $locale);

        if (!is_null($relatedPageID)) {
            return $relatedPageID;
        }

        return $pageID;
    }

    /**
     * @return string
     */
    public function getSiteTreeHomeLink()
    {
        $c = \Page::getCurrentPage();

        return $c->getSiteTreeObject()->getSiteHomePageObject()->getCollectionLink();
    }

    /**
     * @param string $link
     * @param array $attributes
     *
     * @return void
     */
    public function renderEditableAreaWrapperStart($link, $attributes = array()) {
        $c = \Page::getCurrentPage();

        if ($c->isEditMode()) {
            $html = '<div ';
            foreach ($attributes as $attribute => $value) {
                $html .= $attribute . '="' . $value . '" ';
            }

        } else {
            $html = '<a href="' . $link . '" ';
            foreach ($attributes as $attribute => $value) {
                $html .= $attribute . '="' . $value . '" ';
            }
        }

        $html .= '">';

        echo $html;
    }

    /**
     * @return void
     */
    public function renderEditableAreaWrapperEnd() {
        $c = \Page::getCurrentPage();

        if ($c->isEditMode()) {
            echo '</div>';
        } else {
            echo '</a>';
        }
    }

    /**
     * @param BlockType $blockType
     * @param Area       $area
     * @param Page       $page
     * @param array      $blockArgs
     *
     * @return void
     */
    public function addBlockToArea(BlockType $blockType, Area $area, Page $page, $blockArgs = array())
    {
        $areaHandle = $area->getAreaHandle();

        if ($area->isGlobalArea()) {

            if (is_null(\Stack::getByName($areaHandle))) {
                \Stack::addGlobalArea($areaHandle);
            }

            $stack = \Stack::getByName($areaHandle);
            $stack->addBlock($blockType, 'Main', $blockArgs);

        } else {

            $newBlock = $page->addBlock($blockType, $area, $blockArgs);
            $newBlockID = $newBlock->getBlockID();
            $areaBlockIDs = $page->getBlockIDs($areaHandle);
            $newBlockData = [
                'bID'      => $newBlockID,
                'arHandle' => $areaHandle,
            ];

            if (!is_array($areaBlockIDs)) {
                $areaBlockIDs = array();
            }

            $areaBlockIDs[$areaHandle][] = $newBlockData;
            CacheLocal::set('collection_block_ids', $page->getCollectionID() . ':' . $page->getVersionID(), $areaBlockIDs);

        }

    }

    /**
     * @param \Page $pageObj
     * @param array $filterData
     *
     * @return array
     */
    public function getFilteredPageList(\Page $pageObj, $filterData = array())
    {
        $list = new PageList();
        $list->disableAutomaticSorting();

        if ($filterData['filter_by_page_tree_parent']) {
            $parentCID = $pageObj->getSiteTreeObject()->getSiteHomePageID();
        } else {
            $parentCID = $pageObj->cID;
        }

        if ($filterData['find_in_children']) {
            $list->filterByPath(\Page::getByID($parentCID)->getCollectionPath());
        } else {
            $list->filterByParentID($parentCID);
        }

        if ($filterData['attributes']) {
            foreach ($filterData['attributes'] as $handle => $value) {
                if (is_bool($value) && $value) {
                    $list->filterByAttribute($handle, '', '!=');
                } else {
                    $list->filterByAttribute($handle, $value);
                }
            }
        }

        if ($filterData['tree_node']) {
            if (is_object($filterData['tree_node'])) {
                $topicObj = $filterData['tree_node'];
            } else {
                $topicObj = Topic::getByID(intval($filterData['tree_node']));
            }

            if (is_object($topicObj) && $topicObj instanceof Topic) {
                $list->filterByTopic(intval($topicObj->getTreeNodeID()));
            }
        }

        $list->sortByDisplayOrder();


        if ($filterData['item_per_page']) {
            $list->setItemsPerPage($filterData['item_per_page']);
            $pagination = $list->getPagination();
            $currentPageResults = $pagination->getCurrentPageResults();

            if ($filterData['paginate'] && $pagination->haveToPaginate()) {
                $arguments = array(
                    'prev_message'        => '',
                    'next_message'        => '',
                    'css_active_class'    => 'active',
                    'css_container_class' => 'pagination',
                    'css_prev_class'      => 'prev',
                    'css_next_class'      => 'next',
                    'active_suffix'       => '' ,
                );
                $pagination = $pagination->renderDefaultView($arguments);

                $this->setPageListPagination($pagination);
            }

            return $currentPageResults;
        }

        return $list->getResults();
    }

    /**
     * @param string $pagination
     *
     * @return void
     */
    public function setPageListPagination(string $pagination)
    {
        $this->pageListPagination = $pagination;
    }

    /**
     * @return void
     */
    public function renderPageListPagination()
    {
        if (!is_null($this->pageListPagination)) {
            echo $this->pageListPagination;
        }
    }

    /**
     * @param string $handle
     *
     * @return array
     */
    public function getEntryListByHandle($handle)
    {
        $entity = \Express::getObjectByHandle($handle);
        $list = new EntryList($entity);
        $result = $list->getResults();

        return $result;
    }

    public function getThumbnailData(File $image, $thumb_handle)
    {
        $thumbType = Type::getByHandle($thumb_handle);
        $thumbSrc = $image->getThumbnailURL($thumbType->getBaseVersion());

        $data = [];
        $data['src'] = file_exists(substr($thumbSrc, 1)) ? $thumbSrc : $image->getRelativePath();
        $data['altText'] = $this->getImageAltAttribute($image);
        $data['width'] = $thumbType->getWidth();
        $data['height'] = $thumbType->getHeight();

        return $data;
    }

    /**
     * Returns alt (set by attribute) according to active language
     * @param $file
     * @return string
     */
    public function getImageAltAttribute($file)
    {
        $activeLanguage = $this->getLanguageCode();

        if (is_object($file) && $file->getAttribute('image_alt_attr_' . $activeLanguage)) {
            $alt = $file->getAttribute('image_alt_attr_' . $activeLanguage);
        } else {
            $alt = t('Richemond Hotel');
        }

        return $alt;
    }

    /**
     * @param  Page $page
     *
     * @return void
     */
    public function generateSitemapLevel(Page $page) {

        if ($page->getNumChildren()) {
            $textHelper = \Core::make('helper/text');
            $filterData = [
                'attributes' => [
                    'exclude_sitemapxml' => false,
                ],
            ];

            $children = $this->getFilteredPageList($page, $filterData);
            echo '<ul>';

            foreach ($children as $child) {
                echo '<li>';
                echo    '<a href="' . $child->getCollectionLink() . '">' . $textHelper->shortText($child->getCollectionName(), 26) . '</a>';
                $this->generateSitemapLevel($child);
                echo '</li>';
            }

            echo '</ul>';
        }

    }
}