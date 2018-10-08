<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="mt-55 mb-130 grid-container">
    <div class="grid-x grid-margin-x">
        <div class="medium-4 medium-offset-1 cell">
            <div class="user-editable-content user-editable-content_no-p-margins">
                <?php
                $a = new GlobalArea('our_address_title');
                $a->setAreaDisplayName("Address Title");
                $a->display($c);
                ?>

                <?php
                $a = new Area('adderss_sub_title');
                $a->setAreaDisplayName("Sub Title");
                $a->display($c);
                ?>

                <?php
                $a = new GlobalArea('address');
                $a->setAreaDisplayName('Address');
                $a->display($c);
                ?>
            </div>
        </div>
        <div class="medium-7 cell">
            <div class="user-editable-content user-editable-content_no-p-margins">
                <?php
                $a = new Area('contact_title');
                $a->setAreaDisplayName("Contact Title");
                $a->display($c);
                ?>
                <p>
                    <?php
                    $a = new GlobalArea($handle . '_email_link');
                    $a->setAreaDisplayName('Email Link');
                    $a->display($c);
                    ?>
                </p>
                <p>
                    <?php
                    $a = new GlobalArea($handle . '_phone_link');
                    $a->setAreaDisplayName('Phone Link');
                    $a->display($c);
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>