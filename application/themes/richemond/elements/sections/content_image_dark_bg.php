<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID); ?>

<section class="two-halves two-halves_dark two-halves_bg-velvet two-halves_small two-halves_image-left two-halves_shift-up">
    <div class="two-halves__layer flex-container align-right">
        <div class="emblem"><i class="icon-emblem-richemond"></i></div>
    </div>
    <div class="two-halves__layer">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="large-8 cell">
                    <?php
                    $a = new GlobalArea($handle . '_image');
                    $a->setAreaDisplayName("Image");
                    $a->setCustomTemplate('image', 'templates/img_dragable_false');
                    $a->setPropertiesFromArray(['linkClasses' => 'two-halves__image_shift-up']);
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="two-halves__layer two-halves__layer_content">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="large-7 large-offset-5 cell">
                    <div class="two-halves__content">
                        <div class="content-pattern">
                            <div class="line-y line-y_stick-top"></div>
                            <div class="content-pattern__top">
                                <div class="user-editable-content user-editable-content_h4-is-black">
                                    <?php
                                    $a = new Area($handle . '_title');
                                    $a->setAreaDisplayName("Title");
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                            <div class="user-editable-content user-editable-content_text-center">
                                <?php
                                $a = new Area($handle . '_text');
                                $a->setAreaDisplayName("Text");
                                $a->display($c);
                                ?>
                            </div>
                            <div class="content-pattern__buttons flex-container align-center">
                                <?php
                                $a = new Area($handle . '_buttons');
                                $a->setAreaDisplayName("Buttons");
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>