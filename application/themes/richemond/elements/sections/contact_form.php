<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="grid-container">
    <div class="plate__white">
        <div class="plate__content pt-80 pb-70">
            <div class="grid-x grid-margin-x">
                <div class="medium-10 medium-offset-1 cell">
                    <div class="user-editable-content user-editable-content_text-center">
                        <?php
                        $a = new Area('reservation_' . $handle . '_text');
                        $a->setAreaDisplayName('Text');
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
            <?php
            $a = new GlobalArea('reservation_' . $handle);
            $a->setCustomTemplate('form', 'templates/reservation_' . $handle);
            $a->setAreaDisplayName('Form');
            $a->display($c);
            ?>
        </div>
    </div>
</div>