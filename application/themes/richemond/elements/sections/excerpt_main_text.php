<?php defined('C5_EXECUTE') or die("Access Denied.");

$textHelper = Core::make('helper/text');
$pageName = $c->getCollectionName();
$pageShortName = $textHelper->shortText($pageName, 20); ?>

<div class="mt-60 grid-container">
    <div class="grid-x">
        <div class="medium-8 medium-offset-2 cell">
            <div class="user-editable-content">
                <?php
                $a = new GlobalArea($handle . '_excerpt_' . $c->cID);
                $a->setAreaDisplayName('Excerpt ' . $pageShortName);
                if ($c->isEditMode()) {
                    $a->display($c);
                }
                ?>
                <?php
                $a = new Area('page_main_text');
                $a->setAreaDisplayName('Information');
                $a->display($c);
                ?>
            </div>
        </div>
    </div>
</div>