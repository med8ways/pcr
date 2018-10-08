<?php defined('C5_EXECUTE') or die("Access Denied.");

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);

if (!$c->isEditMode()) { ?>
    <div class="owl-carousel"
    <?php
    if ($attributes) {
        foreach ($attributes as $attribute => $value) {
            echo $attribute . "=\"" . $value . "\"";
        }
    }
    ?>
    >
    <?php
}
    $a = new GlobalArea($handle . '_slider_' . $baseLocaleCID);
    $a->setAreaDisplayName('Spa Slider');
    $a->setCustomTemplate('image_slider', 'templates/accommodation_detail');
    $a->display($c);

if (!$c->isEditMode()) { ?>
    </div>
    <?php
}