<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
?>

    <section class="cover">
        <div class="cover__image">
            <?php
            $a = new GlobalArea('hp_cover_image');
            $a->setAreaDisplayName('Cover Image HP');
            $a->setCustomTemplate('image', 'templates/img_dragable_false_edit_stub');
            $a->display($c);
            ?>
            <?php
            $a = new GlobalArea('hp_cover_video');
            $a->setAreaDisplayName('Cover Video HP');
            $a->setCustomTemplate('video', 'templates/cover_video');
            if ($c->isEditMode()) {
                $a->display($c);
            }
            ?>
        </div>

        <div class="cover__video">
            <?php
            if (!$c->isEditMode()) {
                $a->display($c);
            }
            ?>
        </div>
        <div class="scroll">
            <div class="scroll__line"></div>
            <button class="scroll__button">
                <?php
                $a = new GlobalArea('scroll_text');
                $a->setAreaDisplayName('Scroll Text');
                $a->display($c);
                ?>
            </button>
        </div>
        <div class="cover__overlay">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="medium-10 medium-offset-1 cell">
                        <div class="flex-container flex-dir-column align-middle">
                            <div class="line-y"></div>
                            <div class="cover__uppertext">
                                <?php
                                $a = new Area('hp_cover_image_title');
                                $a->setAreaDisplayName('Cover Image Title HP');
                                $a->display($c);
                                ?>
                            </div>
                            <div class="cover__title cover__title_big">
                                <?php
                                $a = new Area('hp_cover_image_text');
                                $a->setAreaDisplayName('Cover Image Text HP');
                                $a->display($c);
                                ?>
                            </div>
                            <button class="play icon-playback-play"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section_intro">
        <div class="grid-container">
            <div class="content-pattern">
                <div class="text-center">
                    <div class="emblem emblem_small emblem_white emblem_collapsed"><i class="icon-emblem-richemond"></i></div>
                </div>
                <div class="content-pattern__decor">
                    <?php
                    $a = new GlobalArea('why_geneva_icon_hp');
                    $a->setAreaDisplayName("Case icon");
                    $a->display($c);
                    ?>
                </div>
                <div class="content-pattern__top">
                    <?php
                    $a = new Area('why_geneva_title');
                    $a->setAreaDisplayName("Why Geneva Icon");
                    $a->display($c);
                    ?>
                </div>
                <div class="line-x"></div>
                <div class="user-editable-content user-editable-content_no-p-margins">
                    <?php
                    $a = new Area('why_geneva_text');
                    $a->setAreaDisplayName("Why Geneva Text");
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class="two-halves two-halves_bg-none two-halves_border-thin">
        <div class="two-halves__layer">
            <div class="grid-x">
                <div class="large-6 large-offset-6 cell">
                    <?php
                    $a = new GlobalArea('accommodation_image_hp');
                    $a->setAreaDisplayName("Rooms & Suites Image HP");
                    $a->setCustomTemplate('image', 'templates/img_dragable_false');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
        <div class="two-halves__layer two-halves__layer_content">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="large-6 cell">
                        <div class="two-halves__content">
                            <div class="content-pattern">
                                <div class="content-pattern__decor">
                                    <?php
                                    $a = new GlobalArea('accommodation_icon_hp');
                                    $a->setAreaDisplayName("Rooms & Suites Icon");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__top">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area('accommodation_title');
                                        $a->setAreaDisplayName("Rooms & Suites Title");
                                        $a->setCustomTemplate('file', 'templates/button');
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="line-x"></div>
                                <div class="freeze-height">
                                    <?php
                                    $a = new GlobalArea('accommodation_list_hp');
                                    $a->setAreaDisplayName("Rooms & Suites list");
                                    $a->setCustomTemplate('page_list', 'templates/accommodation_list');
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
    <section class="two-halves two-halves_shift-up">
        <div class="two-halves__layer align-self-top">
            <div class="emblem"><i class="icon-emblem-richemond"></i></div>
        </div>
        <div class="two-halves__layer">
            <div class="grid-x">
                <div class="large-8 large-offset-4 cell">
                    <?php
                    $a = new GlobalArea('restaurant_image_hp');
                    $a->setAreaDisplayName("Restaurant Image HP");
                    $a->setCustomTemplate('image', 'templates/img_dragable_false');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
        <div class="two-halves__layer two-halves__layer_content">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="large-7 cell">
                        <div class="two-halves__content">
                            <div class="content-pattern">
                                <div class="content-pattern__decor">
                                    <?php
                                    $a = new GlobalArea('restaurant_icon');
                                    $a->setAreaDisplayName("Restaurant icon");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__top">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area('restaurant_title');
                                        $a->setAreaDisplayName("Restaurant Title");
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="line-x"></div>
                                <div class="user-editable-content">
                                    <?php
                                    $a = new Area('restaurant_text');
                                    $a->setAreaDisplayName("Restaurant Text");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__entries">
                                    <div class="entry-with-icon">
                                        <div class="entry-with-icon__image">
                                            <?php
                                            $a = new GlobalArea('hp_restaurant_entry_icon_1');
                                            $a->setAreaDisplayName("Icon");
                                            $a->display($c);
                                            ?>
                                        </div>
                                        <div class="entry-with-icon__text">
                                            <?php
                                            $a = new Area('hp_restaurant_entry_text_1');
                                            $a->setAreaDisplayName("Content");
                                            $a->display($c);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="entry-with-icon">
                                        <div class="entry-with-icon__image">
                                            <?php
                                            $a = new GlobalArea('hp_restaurant_entry_icon_2');
                                            $a->setAreaDisplayName("Icon");
                                            $a->display($c);
                                            ?>
                                        </div>
                                        <div class="entry-with-icon__text">
                                            <?php
                                            $a = new GlobalArea('restaurant_schedule');
                                            $a->setAreaDisplayName('Schedule');
                                            $a->display($c);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-pattern__buttons flex-container align-justify">
                                    <?php
                                    $a = new Area('hp_restaurant_buttons');
                                    $a->setAreaDisplayName("Restaurant Buttons");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__call-us">
                                    <p>
                                        <?php
                                        $a = new GlobalArea('hesitate_call_text');
                                        $a->setAreaDisplayName('Hesitate To Call Text');
                                        $a->display($c);
                                        ?>

                                        <?php
                                        $a = new GlobalArea('restaurant_phone_link');
                                        $a->setAreaDisplayName('Phone Link');
                                        $a->display($c);
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $this->inc('elements/sections/halves_stacked_section.php', ['handle' => 'meeting']);
    ?>
    <section class="two-halves two-halves_bg-gray two-halves_image-left two-halves_shift-up">
        <div class="two-halves__layer align-self-top flex-container align-right">
            <div class="emblem"><i class="icon-emblem-richemond"></i></div>
        </div>
        <div class="two-halves__layer">
            <div class="grid-x">
                <div class="large-8 cell">
                    <?php
                    $a = new GlobalArea('spa_image_hp');
                    $a->setAreaDisplayName("Spa Image HP");
                    $a->setCustomTemplate('image', 'templates/img_dragable_false');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
        <div class="two-halves__layer two-halves__layer_content">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="large-7 large-offset-5 cell">
                        <div class="two-halves__content">
                            <div class="content-pattern">
                                <div class="content-pattern__decor">
                                    <?php
                                    $a = new GlobalArea('spa_icon_hp');
                                    $a->setAreaDisplayName("Spa Icon HP");
                                    $a->setCustomTemplate('image', 'templates/img_dragable_false');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__top">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area('spa_title');
                                        $a->setAreaDisplayName("SPA Title");
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="line-x"></div>
                                <div class="user-editable-content">
                                    <?php
                                    $a = new Area('spa_text');
                                    $a->setAreaDisplayName("SPA Text");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__entries">
                                    <div class="entry-with-icon">
                                        <div class="entry-with-icon__image">
                                            <?php
                                            $a = new GlobalArea('hp_spa_entry_icon_1');
                                            $a->setAreaDisplayName("Icon");
                                            $a->display($c);
                                            ?>
                                        </div>
                                        <div class="entry-with-icon__text">
                                            <?php
                                            $a = new GlobalArea('spa_schedule');
                                            $a->setAreaDisplayName('Schedule');
                                            $a->display($c);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="entry-with-icon">
                                        <div class="entry-with-icon__image">
                                            <?php
                                            $a = new GlobalArea('hp_spa_entry_icon_2');
                                            $a->setAreaDisplayName("Icon");
                                            $a->display($c);
                                            ?>
                                        </div>
                                        <div class="entry-with-icon__text">
                                            <?php
                                            $a = new Area('hp_spa_entry_text_2');
                                            $a->setAreaDisplayName("Content");
                                            $a->display($c);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-pattern__buttons flex-container align-justify">
                                    <?php
                                    $a = new Area('spa_buttons');
                                    $a->setAreaDisplayName("SPA Buttons");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__call-us">
                                    <p>
                                        <?php
                                        $a = new GlobalArea('hesitate_call_text');
                                        $a->setAreaDisplayName('Hesitate To Call Text');
                                        $a->display($c);
                                        ?>

                                        <?php
                                        $a = new GlobalArea('spa_phone_link');
                                        $a->setAreaDisplayName('Phone Link');
                                        $a->display($c);
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->inc('elements/sections/content_image_dark_bg.php', ['handle' => 'home']); ?>
    <section class="two-halves two-halves_bg-velvet two-halves_small">
        <div class="two-halves__layer">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="large-7 large-offset-5 cell">
                        <?php
                        $a = new GlobalArea('contacts_image_hp');
                        $a->setAreaDisplayName("Contacts Image HP");
                        $a->setCustomTemplate('image', 'templates/img_dragable_false');
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="two-halves__layer">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="large-6 cell">
                        <div class="two-halves__content two-halves__content_outline-white">
                            <div class="content-pattern">
                                <div class="line-x line-x_stick-right"></div>
                                <div class="user-editable-content user-editable-content_no-p-margins">
                                    <?php
                                    $a = new Area('contacts_title');
                                    $a->setAreaDisplayName("Contacts Title");
                                    $a->display($c);
                                    ?>
                                    <?php
                                    $a = new GlobalArea('address');
                                    $a->setAreaDisplayName('Address');
                                    $a->display($c);
                                    ?>
                                    <p>&nbsp;</p>
                                    <p>
                                        <?php
                                        $a = new GlobalArea('phone_link');
                                        $a->setAreaDisplayName('Phone Link');
                                        $a->display($c);
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section_news">
        <div class="grid-container">
            <div class="content-pattern">
                <div class="content-pattern__top">
                    <?php
                    $a = new Area('follow_title');
                    $a->setAreaDisplayName("Follow Title");
                    $a->display($c);
                    ?>
                </div>
                <div class="line-x"></div>
            </div>
            <?php
            $a = new GlobalArea('social_links_hp');
            $a->setAreaDisplayName('Social Links');
            if ($c->isEditMode()) {
                $a->display($c);
            }
            ?>
            <div class="grid-x align-center">
                <?php
                if ($a->getTotalBlocksInArea($c)) {
                    $areaBlocks = $a->getAreaBlocksArray($c);
                    $socialLinksBlockObj = $areaBlocks[0];
                    $socialLinksBlockController = $socialLinksBlockObj->getController();
                    $socialLinks = $socialLinksBlockController->getSelectedLinks();

                    foreach ($socialLinks as $link) {
                        $service = $link->getServiceObject();
                        $handle = $service->getHandle(); ?>
                        <div class="small-6 medium-3 cell">
                            <?php $theme->renderEditableAreaWrapperStart($link->getURL(), ["class" => "news-item"]); ?>
                                <div class="news-item__image">
                                    <?php
                                    $a = new GlobalArea('social_link_image_' . $handle);
                                    $a->setAreaDisplayName('Social Link Image ' . $handle);
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="news-item__bottom">
                                    <i class="icon-<?php echo $handle; ?>"></i>
                                    <div class="news-item__text">
                                        <p><?php echo $handle; ?></p>
                                    </div>
                                </div>
                            <?php $theme->renderEditableAreaWrapperEnd(); ?>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

<?php
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
