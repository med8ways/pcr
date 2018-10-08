<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$section_handle = 'conciergerie';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php'); ?>


    <section class="section section_intro">
        <div class="grid-container">
            <div class="grid-x">
                <div class="medium-8 medium-offset-2 cell">
                    <div class="content-pattern">
                        <div class="text-center">
                            <div class="emblem emblem_small emblem_white emblem_collapsed"><i class="icon-emblem-richemond"></i></div>
                        </div>
                        <div class="content-pattern__decor">
                            <?php
                            $a = new GlobalArea($section_handle . '_icon');
                            $a->setAreaDisplayName("Icon");
                            $a->setCustomTemplate('image', 'templates/img_dragable_false');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="content-pattern__top">
                            <div class="user-editable-content">
                                <?php
                                $a = new Area('info_title');
                                $a->setAreaDisplayName("Info Title");
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                        <div class="line-x"></div>
                    </div>
                    <div class="user-editable-content user-editable-content_no-p-margins user-editable-content_links-are-red">
                        <?php
                        $a = new Area('info_text');
                        $a->setAreaDisplayName("Info Text");
                        $a->display($c);
                        ?>
                    </div>
                    <div class="mt-40 toggleable-layers">
                        <div class="toggleable-layers__toggles tabs-toggles tabs-toggles_grow">
                            <ul>
                                <li>
                                    <div class="entry-with-icon">
                                        <div class="entry-with-icon__image"><i class="icon-train"></i></div>
                                        <div class="entry-with-icon__text">
                                            <by>
                                                <?php
                                                $a = new Area('by_train_title');
                                                $a->setAreaDisplayName("By Train Title");
                                                $a->display($c);
                                                ?>
                                            </by>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="entry-with-icon">
                                        <div class="entry-with-icon__image"><i class="icon-plane"></i></div>
                                        <div class="entry-with-icon__text">
                                            <by>
                                                <?php
                                                $a = new Area('by_air_title');
                                                $a->setAreaDisplayName("By Air Title");
                                                $a->display($c);
                                                ?>
                                            </by>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="entry-with-icon">
                                        <div class="entry-with-icon__image"><i class="icon-car"></i></div>
                                        <div class="entry-with-icon__text">
                                            <by>
                                                <?php
                                                $a = new Area('by_car_title');
                                                $a->setAreaDisplayName("By Car Title");
                                                $a->display($c);
                                                ?>
                                            </by>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="toggleable-layers__layers mt-40 align-stretch">
                            <div class="user-editable-content">
                                <?php
                                $a = new Area('by_train_text');
                                $a->setAreaDisplayName("By Train Text");
                                $a->display($c);
                                ?>
                            </div>
                            <div class="user-editable-content">
                                <?php
                                $a = new Area('by_air_text');
                                $a->setAreaDisplayName("By Train Text");
                                $a->display($c);
                                ?>
                            </div>
                            <div class="user-editable-content">
                                <?php
                                $a = new Area('by_car_text');
                                $a->setAreaDisplayName("By Car Text");
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="mt-40 content-pattern">
                        <?php
                        $a = new GlobalArea('youtube_video');
                        $a->setAreaDisplayName("YouTube Video");
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-60 grid-container">
        <div class="user-editable-content user-editable-content_text-center">
            <?php
            $a = new Area('do_in_geneva');
            $a->setAreaDisplayName("What to do in Geneva");
            $a->display($c);
            ?>
        </div>
        <div class="mt-50 grid-x grid-margin-x cards-row">

            <?php
            $handle = 'do_in_geneva';
            $entries = $theme->getEntryListByHandle($handle);

            foreach ($entries as $entry) {
                $entryTitle = $entry->getAttribute($handle . '_title_fr');
                $entryShortTitle = $textHelper->shortText($entryTitle, 20);
                $entryID = $entry->getID(); ?>

                <div class="medium-6 large-4 cell">
                    <div class="card card_small card_popup">
                        <div class="card__image">
                            <?php
                            $a = new GlobalArea($handle . '_image_' . $entryID);
                            $a->setAreaDisplayName('Image ' . $entryShortTitle);
                            $a->setCustomTemplate('image', 'templates/img_dragable_false_edit_stub');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="card__text">
                            <div class="card__title">
                                <?php
                                $a = new Area($handle . '_title_' . $entryID);
                                if (!$a->getTotalBlocksInArea($c)) {

                                    if (!isset($blockTypeContent)) {
                                        $blockTypeContent = BlockType::getByHandle('content');
                                    }

                                    $theme->addBlockToArea($blockTypeContent, $a, $c, ['content' => '<p>' . $entryTitle . '</p>']);
                                }
                                $a->setAreaDisplayName('Title ' . $entryShortTitle);
                                $a->display($c);
                                ?>
                            </div>
                            <div class="user-editable-content user-editable-content_text-center user-editable-content_no-p-margins">
                                <?php
                                $a = new Area($handle . '_text_' . $entryID);
                                if (!$a->getTotalBlocksInArea($c)) {

                                    if (!isset($blockTypeContent)) {
                                        $blockTypeContent = BlockType::getByHandle('content');
                                    }

                                    $theme->addBlockToArea($blockTypeContent, $a, $c, ['content' => '<p>Text</p>']);
                                }
                                $a->setAreaDisplayName('Title ' . $entryShortTitle);
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__buttons">
                                <?php
                                $a = new Area('do_in_geneva_link_' . $entryID);
                                $a->setAreaDisplayName('What Do In Geneva Link');
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
    <div class="mt-60 grid-container">
        <?php
        $a = new GlobalArea('contact_map');
        $a->setAreaDisplayName('Contact Map');
        $a->setCustomTemplate('google_map', 'templates/contact_page');
        $a->display($c);
        ?>
    </div>
    <?php $this->inc('elements/sections/content_image_dark_bg.php', ['handle' => $section_handle]); ?>
    <section class="two-halves two-halves_stacked two-halves_bg-velvet">
        <div class="two-halves__layer">
            <?php
            $a = new GlobalArea($section_handle . '_1_image');
            $a->setAreaDisplayName("Image");
            $a->setCustomTemplate('image', 'templates/img_dragable_false');
            $a->display($c);
            ?>
        </div>
        <div class="two-halves__layer two-halves__layer_content">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="large-8 large-offset-2 cell">
                        <div class="two-halves__content">
                            <div class="content-pattern">
                                <div class="content-pattern__top">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area($section_handle . '_map_title');
                                        $a->setAreaDisplayName("Title");
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="line-x"></div>
                                <div class="user-editable-content user-editable-content_text-center">
                                    <?php
                                    $a = new Area($section_handle . '_map_text');
                                    $a->setAreaDisplayName("Text");
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

<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
