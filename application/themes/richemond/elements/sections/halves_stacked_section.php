<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID); ?>

<section class="two-halves two-halves_stacked">
    <div class="two-halves__layer">
        <div class="two-halves__image">
            <?php
            $a = new GlobalArea($handle . '_image');
            $a->setAreaDisplayName($handle . " Image");
            $a->setCustomTemplate('image', 'templates/img_dragable_false');
            $a->display($c);
            ?>
        </div>
    </div>
    <div class="two-halves__layer two-halves__layer_content">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="large-8 large-offset-2 cell">
                    <div class="two-halves__content">
                        <div class="content-pattern">
                            <div class="content-pattern__decor">
                                <?php
                                $a = new GlobalArea($handle . '_icon');
                                $a->setAreaDisplayName($handle . " icon");
                                $a->display($c);
                                ?>
                            </div>
                            <div class="content-pattern__top">
                                <div class="user-editable-content">
                                    <?php
                                    $a = new Area('meeting_title');
                                    $a->setAreaDisplayName("Meeting Title");
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                            <div class="line-x"></div>
                            <div class="user-editable-content">
                                <?php
                                $a = new Area('meeting_text');
                                $a->setAreaDisplayName("Meeting Text");
                                $a->display($c);
                                ?>
                            </div>
                            <div class="content-pattern__buttons flex-container align-center">
                                <?php
                                $a = new Area('meeting_buttons');
                                $a->setAreaDisplayName("Meeting Buttons");
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