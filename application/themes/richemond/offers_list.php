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

    <section class="top-block mb-60">
        <div class="grid-container">
            <?php
            $this->inc('elements/sections/top_block_without_image.php');
            ?>
            <div class="mt-60 tags">
                <?php
                $a = new GlobalArea('label_offers_nav');
                $a->setAreaDisplayName('Label Offers nav');
                $a->setCustomTemplate('topic_list', 'templates/event_periods');
                $a->display($c);
                ?>
            </div>
        </div>
    </section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <?php

            $moreDetailsLinkAttributes = [
                'externalLinkType'  => 'sitemap_link',
                'externalLinkText'  => tc('OfferList','More details'),
                'externalLinkClass' => 'button button_light',
            ];

            if ($c->getAttribute('items_per_page')) {
                $itemsPerPage = $c->getAttribute('items_per_page');
                $paginate = $c->getAttribute('paginate');
            } else {
                $itemsPerPage = 6;
                $paginate = false;
            }

            $filterData = [
                'attributes'                 => ['exclude_page_list' => '0'],
                'item_per_page' => $itemsPerPage,
                'paginate' => $paginate
            ];

            if ($GLOBALS['selectedTopicID']) {
                $filterData['tree_node'] = $GLOBALS['selectedTopicID'];
            }

            $items = $theme->getFilteredPageList($c, $filterData);

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
                            $a->disableControls();
                            $a->setCustomTemplate('image', 'templates/accommodation_list');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="card__text">
                            <div class="card__date">
                                <p>
                                    <?php
                                    echo $dateHelper->formatCustom('d M Y', $item->getAttribute('offer_date_start'));
                                    if ($item->getAttribute('offer_date_end')) {
                                        echo ' ' .  t('to') . ' ';
                                        echo $dateHelper->formatCustom('d M Y', $item->getAttribute('offer_date_end'));
                                    }
                                    ?>
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
                                $a = new GlobalArea('offer_excerpt_' . $itemCID);
                                $a->setAreaDisplayName('Treatment Excerpt ' . $itemShortName);
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__buttons">
                                <?php
                                $a = new Area('suite_buttons_' . $itemCID);
                                if (!$a->getTotalBlocksInArea($c)) {
                                    $moreDetailsLinkAttributes['externalLinkCID'] = $itemCID;

                                    if (!isset($blockTypeExternalLink)) {
                                        $blockTypeExternalLink = BlockType::getByHandle('external_link');
                                    }

                                    $theme->addBlockToArea($blockTypeExternalLink, $a, $c, $moreDetailsLinkAttributes);
                                }
                                $a->setAreaDisplayName('Buttons ' . $suiteShortName);
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
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