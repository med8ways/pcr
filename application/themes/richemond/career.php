<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$dateHelper = Core::make('helper/date');
$langCode = $theme->getLanguageCode();
$section_handle = 'career';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php'); ?>

    <div class="grid-container mt-90">
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

                $viewMoreTextArea = new GlobalArea('view_more_text_' . $langCode);
                $viewMoreTextArea->setAreaDisplayName('Book Now Text');

                foreach ($items as $item) {

                    $itemCID = $item->cID;
                    $itemBaseLocaleCID = $theme->getPageIDInBaseLocale($itemCID);
                    $itemName = $item->getCollectionName();
                    $itemShortName = $textHelper->shortText($itemName, 20);
                    ?>
                    <div class="medium-6 cell">
                        <div class="card card_job">
                            <div class="card__image">
                                <?php
                                $a = new GlobalArea('main_image_' . $itemBaseLocaleCID);
                                $a->disableControls();
                                $a->setCustomTemplate('image', 'templates/accommodation_list');
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__text">
                              <!--  <div class="card__date">
                                    <p>
                                        <?php echo $dateHelper->formatCustom('M d, Y', $item->getCollectionDatePublic()); ?>
                                    </p>
                                </div>-->
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
                                    $a = new GlobalArea('vacancy_excerpt_' . $itemCID);
                                    $a->setAreaDisplayName('Vacancy Excerpt ' . $itemShortName);
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="card__buttons">
                                    <?php
                                    $theme->renderEditableAreaWrapperStart($item->getCollectionLink(), ["class" => "button button_light"]); ?>
                                        <div class="button__bg"></div>
                                        <span class="button__text"><?php $viewMoreTextArea->display($c); ?></span>
                                    <?php
                                    $theme->renderEditableAreaWrapperEnd(); ?>
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
        } ?>
    </div>

<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');