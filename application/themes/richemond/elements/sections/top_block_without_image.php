<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="grid-x grid-margin-x">
    <div class="medium-8 medium-offset-2 cell">
        <div class="line-y"></div>
        <div class="text-center">
            <div class="emblem emblem_small emblem_white emblem_collapsed">
                <i class="icon-emblem-richemond"></i>
            </div>
        </div>
        <div class="user-editable-content user-editable-content_text-center">
            <?php
            $a = new Area('cover_image_uppertext');
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
                    $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $c->getCollectionName()]);
                }
                $a->setAreaDisplayName('Page Title ' . $pageShortName);
                $a->display($c);
                ?>
            </h1>
        </div>
    </div>
</div>