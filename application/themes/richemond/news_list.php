<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c          \Concrete\Core\Page\Page
 * @var $theme      \Application\Theme\Richemond\PageTheme
 * @var $dateHelper \Concrete\Core\Localization\Service\Date
 * @var $item       \Concrete\Core\Page\Page
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$dateHelper = Core::make('helper/date');
$textHelper = Core::make('helper/text');
$section_handle = 'spa_treatments';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php'); ?>

    <section class="top-block">
        <div class="grid-container">
            <?php
            $this->inc('elements/sections/top_block_without_image.php');
            ?>
        </div>
    </section>
    <section class="news">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-10 large-offset-1 cell">
                    <div class="news-grid">
                        <div class="grid-x grid-margin-x">

                            <?php

                            if ($c->getAttribute('items_per_page')) {
                                $itemsPerPage = $c->getAttribute('items_per_page');
                                $paginate = $c->getAttribute('paginate');
                            } else {
                                $itemsPerPage = 6;
                                $paginate = false;
                            }

                            $items = $theme->getFilteredPageList($c, ['item_per_page' => $itemsPerPage, 'paginate' => $paginate]);
                            $i = 1;

                            foreach ($items as $item) {

                                $itemCID = $item->cID;
                                $itemBaseLocaleCID = $theme->getPageIDInBaseLocale($itemCID);
                                $itemName = $item->getCollectionName();
                                $itemShortName = $textHelper->shortText($itemName, 20);
                                ?>
                                <div class="medium-6 cell">
                                    <?php
                                    $theme->renderEditableAreaWrapperStart($item->getCollectionLink(), ["class" => "card"]);
                                    ?>
                                        <div class="card__image">
                                            <?php
                                            $a = new GlobalArea('main_image_' . $itemBaseLocaleCID);
                                            $a->disableControls();
                                            $a->setCustomTemplate('image', 'templates/accommodation_list');
                                            $a->display($c);
                                            ?>
                                        </div>
                                        <div class="card__text">
                                            <div class="card__date">
                                                <p>
                                                    <?php echo $dateHelper->formatCustom('M d, Y', $item->getCollectionDatePublic()); ?>
                                                </p>
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
                                        </div>
                                    <?php
                                    $theme->renderEditableAreaWrapperEnd();
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($paginate) {
                        $theme->renderPageListPagination();
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
