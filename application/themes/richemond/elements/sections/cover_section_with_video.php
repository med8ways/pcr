<?php defined('C5_EXECUTE') or die("Access Denied.");

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$langCode = $theme->getLanguageCode(); ?>

<section class="cover">
    <div class="cover__image">
        <?php
        $a = new GlobalArea('main_image_' . $baseLocaleCID);
        $a->setAreaDisplayName('Cover Main Image');
        $a->setCustomTemplate('image', 'templates/img_dragable_false_edit_stub');
        $a->display($c);
        ?>
        <?php
        $a = new GlobalArea('cover_video_' . $baseLocaleCID);
        $a->setAreaDisplayName('Cover Video');
        $a->setCustomTemplate('video', 'templates/cover_video');
        if ($c->isEditMode()) {
            $a->display($c);
        }
        ?>
    </div>

    <div class="cover__video">
        <?php
        if (!$c->isEditMode()) {
            $a->display($c);
        }
        ?>
    </div>
    <div class="cover__overlay">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="medium-10 medium-offset-1 cell">
                    <div class="flex-container flex-dir-column align-middle">
                        <div class="line-y"></div>
                        <div class="cover__uppertext">
                            <?php
                            $a = new Area('cover_image_uppertext');
                            if (!$a->getTotalBlocksInArea($c)) {
                                $blockTypeText = BlockType::getByHandle('text');
                                $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $c->getCollectionName()]);
                            }
                            $a->setAreaDisplayName('Cover Image Uppertext');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="cover__title">
                            <?php
                            $a = new Area('cover_image_title');
                            $a->setAreaDisplayName('Cover Image Title');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="user-editable-content user-editable-content_text-center o-80">
                            <?php
                            $a = new Area('cover_image_text');
                            $a->setAreaDisplayName('Cover Image Text');
                            $a->display($c);
                            ?>
                        </div>
                        <button class="play icon-playback-play"></button>
                        <div class="user-editable-content mt-5">
                            <h4>
                                <?php
                                $a = new GlobalArea('play_video_' . $langCode);
                                if (!$a->getTotalBlocksInArea()) {
                                    if (!isset($blockTypeText)) {
                                        $blockTypeText = BlockType::getByHandle('text');
                                    }
                                    $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => 'Play Video']);
                                }
                                $a->setAreaDisplayName('Play Video Text');
                                $a->display($c);
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>