<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c                         \Concrete\Core\Page\Page
 * @var $theme                     \Application\Theme\Richemond\PageTheme
 * @var $pageTopicsBlockController \Application\Block\TopicList\Controller
 * @var $pageTopicsBlockObj        \Concrete\Core\Block\Block
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');

$this->inc('elements/header_top.php');
$this->inc('elements/header.php'); ?>

    <section class="top-block mb-60">
        <div class="grid-container">
            <div class="grid-x">
                <div class="medium-8 medium-offset-2 cell">
                    <div class="line-y"></div>
                    <div class="text-center">
                        <div class="emblem emblem_small emblem_white emblem_collapsed">
                            <i class="icon-emblem-richemond"></i>
                        </div>
                    </div>
                    <div class="user-editable-content user-editable-content_text-center">
                        <?php
                        $a = new Area('cover_uppertext');
                        $a->setAreaDisplayName('Cover Image Uppertext');
                        $a->display($c);
                        ?>
                        <h1>
                            <?php
                            $a = new GlobalArea('page_title_' . $c->cID);
                            if (!$a->getTotalBlocksInArea()) {
                                if (!isset($blockTypeText)) {
                                    $blockTypeText = BlockType::getByHandle('text');
                                }
                                $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $pageName]);
                            }
                            $a->setAreaDisplayName('Page Title ' . $pageShortName);
                            $a->display($c);
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="mt-60 tags">
                <?php
                $topicListArea = new GlobalArea('label_events_nav');
                $topicListArea->setAreaDisplayName('Label Events nav');
                $topicListArea->setCustomTemplate('topic_list', 'templates/event_periods');
                $topicListArea->display($c);
                ?>
            </div>
        </div>
    </section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">

            <?php
            if ($c->getAttribute('items_per_page')) {
                $itemsPerPage = $c->getAttribute('items_per_page');
                $paginate = $c->getAttribute('paginate');
            } else {
                $itemsPerPage = 6;
                $paginate = false;
            }

            $filterData = [
                'item_per_page' => $itemsPerPage,
                'paginate' => $paginate
            ];

            if ($GLOBALS['selectedTopicID']) {
                $filterData['tree_node'] = $GLOBALS['selectedTopicID'];
            }

            $items = $theme->getFilteredPageList($c, $filterData);
            $i = 1;

            foreach ($items as $item) {

                $itemCID = $item->cID;
                $itemBaseLocaleCID = $theme->getPageIDInBaseLocale($itemCID);
                $itemName = $item->getCollectionName();
                $itemShortName = $textHelper->shortText($itemName, 20);
                ?>

                <div class="medium-6 cell">
                    <div class="card card_event card_popup">
                        <div class="card__image">
                            <?php
                            $a = new GlobalArea('main_image_' . $itemBaseLocaleCID);
                            $a->setCustomTemplate('image', 'templates/accommodation_list');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="card__text">
                            <div class="card__date">
                                <?php
                                $a = new GlobalArea('event_month_' . $itemCID);
                                $a->setAreaDisplayName('Label Events Nav ' . $itemShortName);
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__title">
                                <p>
                                    <?php
                                    $a = new GlobalArea('page_title_' . $itemCID);
                                    if (!$a->getTotalBlocksInArea()) {

                                        if (!isset($blockTypeText)) {
                                            $blockTypeText = BlockType::getByHandle('text');
                                        }

                                        $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $itemName]);
                                    }
                                    $a->setAreaDisplayName('Page Title ' . $itemShortName);
                                    $a->display($c);
                                    ?>
                                </p>
                            </div>
                            <div class="user-editable-content user-editable-content_text-center user-editable-content_no-p-margins">
                                <?php
                                $a = new GlobalArea('treatment_excerpt_' . $itemCID);
                                $a->setAreaDisplayName('Treatment Excerpt ' . $itemShortName);
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__buttons">

                                <?php
                                $a = new GlobalArea('menu_file_link_' . $itemCID);
                                $a->setAreaDisplayName('File Link ' . $itemShortName);
                                $a->setCustomTemplate('file', 'templates/button_light');
                                $a->display($c);
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
<?php
if ($paginate) {
    $theme->renderPageListPagination();
}

$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
