<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="mt-30 grid-container">
    <div class="user-editable-content user-editable-content_text-center">
        <?php
        $a = new Area($handle . '_table_title' . $itemCID);
        $a->setAreaDisplayName('Capacity Charts Title ' . $itemShortName);
        $a->display($c);
        ?>
    </div>
    <div class="mt-40">
        <div class="user-editable-content user-editable-content_scrollable">
            <?php
            $a = new Area($handle . '_table_' . $itemCID);
            $a->setAreaDisplayName('Capacity Charts Table ' . $itemShortName);
            $a->display($c);
            ?>
        </div>
    </div>
</div>