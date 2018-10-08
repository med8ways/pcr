<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID); ?>

<section class="section section_intro">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="medium-8 medium-offset-2 cell">
                <div class="content-pattern">
                    <div class="text-center">
                        <div class="emblem emblem_small emblem_white emblem_collapsed"><i class="<?php echo $emblemIcon ?: 'icon-emblem-richemond' ?>"></i></div>
                    </div>
                    <div class="content-pattern__decor">
                        <?php
                        $a = new GlobalArea($handle . '_icon_hp');
                        $a->setAreaDisplayName("Icon");
                        $a->setCustomTemplate('image', 'templates/img_dragable_false');
                        $a->display($c);
                        ?>
                    </div>
                    <div class="content-pattern__top">
                        <div class="user-editable-content">
                            <?php
                            $a = new Area('info_title' . $areaModifier);
                            $a->setAreaDisplayName("Info Title");
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                    <div class="line-x"></div>
                </div>
            </div>
        </div>
        <div class="user-editable-content <?php echo $oneColumnContent ? "" : "user-editable-content_two-columns"; ?> user-editable-content_no-p-margins">
            <?php
            $a = new Area('info_text' . $areaModifier);
            $a->setAreaDisplayName("Info Text");
            $a->display($c);
            ?>
        </div>
    </div>
</section>
