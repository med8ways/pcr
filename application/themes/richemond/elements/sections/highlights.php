<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<section class="highlights">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="medium-8 medium-offset-2 cell">
                <div class="layers">
                    <div class="emblem mt-100 mb-125 o-5"><i class="icon-emblem-richemond"></i></div>
                    <div class="o-95">
                        <div class="user-editable-content user-editable-content_text-center mb-40">
                            <?php
                            $a = new GlobalArea('highlights_title');
                            $a->setAreaDisplayName("Highlights Title");
                            $a->display($c);
                            ?>
                        </div>
                        <div class="line-x"></div>
                        <div class="user-editable-content user-editable-content_two-columns user-editable-content_ul-disk o-60 mt-55">
                            <?php
                            $a = new Area('highlights');
                            $a->setAreaDisplayName("Highlights");
                            $a->display($c);
                            ?>
                        </div>
                        <div class="mt-55 flex-container align-center">
                            <?php
                            $a = new Area('highlights_reservation_button');
                            $a->setAreaDisplayName("Highlights Reservation Button");
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>