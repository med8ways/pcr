<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<section class="plate plate_fixed dialog">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="medium-10 medium-offset-1 cell">
                <div class="plate__white">
                    <div class="plate__content pt-60 pb-45">
                        <div class="line-y_stick-top"></div>
                        <div class="grid-x grid-margin-x">
                            <div class="medium-10 medium-offset-1 cell">
                                <div class="user-editable-content user-editable-content_text-center">
                                    <?php
                                    $a = new GlobalArea('success_message_' . $handle);
                                    $a->setAreaDisplayName('Success Message');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="text-center mt-30">
                                    <button class="button button_light" type="button">Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>