<?php defined('C5_EXECUTE') or die("Access Denied.");

$textHelper = Core::make('helper/text');
$entryTitle = $entry->getAttribute($handle . '_title_fr');
$entryShortTitle = $textHelper->shortText($entryTitle, 20);
$entryID = $entry->getID(); ?>

<div class="timeline-item">
    <div class="timeline-item__year">
        <?php
        $a = new Area($handle . '_title_' . $entryID);
        if (!$a->getTotalBlocksInArea($c)) {

            if (!isset($blockTypeContent)) {
                $blockTypeContent = BlockType::getByHandle('content');
            }

            $theme->addBlockToArea($blockTypeContent, $a, $c, ['content' => '<p>' . $entryTitle . '</p>']);
        }
        $a->setAreaDisplayName('Title ' . $entryShortTitle);
        $a->display($c);
        ?>
    </div>
    <div class="layers">
        <div class="emblem emblem_white align-self-top"><i class="icon-emblem-richemond"></i></div>
        <div class="align-self-stretch timeline-item__dots">
            <div class="timeline-item__circle"></div>
            <div class="dots"></div>
        </div>
        <div class="layer">
            <div class="grid-x grid-margin-x flex-container align-justify">
                <div class="medium-5 cell">
                    <div class="user-editable-content user-editable-content_no-p-margins">
                        <?php
                        $a = new Area($handle . '_left_col_' . $entryID);
                        $a->setAreaDisplayName('Left Column ' . $entryShortTitle);
                        $a->setCustomTemplate('page_title', 'templates/history_text_block_title');
                        $a->display($c);
                        ?>
                    </div>
                </div>
                <div class="medium-5 cell">
                    <div class="user-editable-content user-editable-content_no-p-margins">
                        <?php
                        $a = new Area($handle . '_right_col_' . $entryID);
                        $a->setAreaDisplayName('Right Column ' . $entryShortTitle);
                        $a->setCustomTemplate('page_title', 'templates/history_text_block_title');
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>