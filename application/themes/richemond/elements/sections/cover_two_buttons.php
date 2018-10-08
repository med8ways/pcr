<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
* @var $theme \Application\Theme\Richemond\PageTheme
*/

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID); ?>

<section class="cover">
    <div class="cover__image" data-clip-path-id="<?php echo $clipPathId ?: 'emblem-richemond'?>">
        <?php
        $a = new GlobalArea('main_image_' . $baseLocaleCID);
        $a->setAreaDisplayName('Main Image');
        $a->setCustomTemplate('image', 'templates/img_dragable_false_edit_stub');
        $a->display($c);
        ?>
    </div>
    <div class="cover__overlay">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="medium-8 medium-offset-2 cell">
                    <div class="flex-container flex-dir-column align-middle">
                        <div class="line-y"></div>
                        <div class="cover__uppertext">
                            <?php
                            $a = new Area('cover_image_uppertext');
                            $a->setAreaDisplayName('Cover Image Uppertext');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="cover__title">
                            <?php
                            $a = new Area('cover_image_title');
                            $a->setAreaDisplayName('Cover Image Title');
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-x grid-margin-x">
                <div class="medium-6 medium-offset-3 cell">
                    <div class="flex-container flex-dir-column align-middle">
                        <div class="user-editable-content user-editable-content_text-center o-80">
                            <?php
                            $a = new Area('cover_image_text');
                            $a->setAreaDisplayName('Cover Image Text');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="mt-65 flex-container align-center">
                            <?php
                            $a = new Area('cover_image_buttons');
                            $a->setAreaDisplayName('Cover Image Buttons');
                            $a->setCustomTemplate('file', 'templates/button_transparent');
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>