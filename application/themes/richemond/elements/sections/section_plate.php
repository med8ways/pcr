<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID); ?>

<section class="top-image">
    <?php
    $a = new GlobalArea('main_image_' . $baseLocaleCID);
    $a->setAreaDisplayName('Main Image');
    $a->setCustomTemplate('image', 'templates/accommodation_detail');
    $a->display($c);
    ?>
</section>
<section class="plate">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="medium-10 medium-offset-1 cell">
                <div class="plate__white">
                    <div class="plate__content">
                        <div class="pt-55 pb-40">
                            <div class="line-y line-y_stick-topleft"></div>
                            <div class="flex-container align-justify align-middle mb-25">
                                <div class="user-editable-content">
                                    <?php
                                    $a = new Area('up_text');
                                    $a->setAreaDisplayName('Up Text');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="social o-80">
                                    <?php
                                    $a = new GlobalArea('share_this');
                                    $a->setAreaDisplayName('Social Share');
                                    $a->setCustomTemplate('share_this_page', 'templates/accommodation_detail');
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                            <div class="user-editable-content">
                                <h1>
                                    <?php
                                    $a = new GlobalArea('page_title_' . $c->cID);
                                    if (!$a->getTotalBlocksInArea()) {
                                        if (!isset($blockTypeText)) {
                                            $blockTypeText = BlockType::getByHandle('text');
                                        }
                                        $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $c->getCollectionName()]);
                                    }
                                    $a->setAreaDisplayName('Page Title ' . $pageShortName);
                                    $a->display($c);
                                    ?>
                                </h1>
                            </div>
                            <div class="mt-35 flex-container align-justify align-middle">
                                <?php
                                $a = new Area('reservation_button');
                                $a->setAreaDisplayName('Reservation Button');
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>