<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$section_handle = 'spa';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php');
$this->inc('elements/sections/section_intro.php', ['handle' => $section_handle]); ?>

    <div class="mt-15">
        <div class="grid-container">
            <div class="grid-x">
                <div class="medium-10 medium-offset-1 cell">
                    <div class="grid-x grid-margin-x">
                        <div class="medium-3 cell">
                            <div class="spa-feature">
                                <div class="spa-feature__image">
                                    <?php
                                    $a = new GlobalArea('treatment_rooms_icon_' . $baseLocaleCID);
                                    $a->setAreaDisplayName('Treatment Rooms Icon');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="spa-feature__text">
                                    <?php
                                    $a = new Area('treatment_rooms_text');
                                    $a->setAreaDisplayName('Treatment Rooms Text');
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="medium-3 cell">
                            <div class="spa-feature">
                                <div class="spa-feature__image">
                                    <?php
                                    $a = new GlobalArea('relaxation_rooms_icon_' . $baseLocaleCID);
                                    $a->setAreaDisplayName('Relaxation Rooms Icon');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="spa-feature__text">
                                    <?php
                                    $a = new Area('relaxation_rooms_text');
                                    $a->setAreaDisplayName('Relaxation Rooms Text');
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="medium-3 cell">
                            <div class="spa-feature">
                                <div class="spa-feature__image">
                                    <?php
                                    $a = new GlobalArea('full_range_icon_' . $baseLocaleCID);
                                    $a->setAreaDisplayName('Full Range Icon');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="spa-feature__text">
                                    <?php
                                    $a = new Area('full_range_text');
                                    $a->setAreaDisplayName('Full Range Text');
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="medium-3 cell">
                            <div class="spa-feature">
                                <div class="spa-feature__image">
                                    <?php
                                    $a = new GlobalArea('gymnasium_icon_' . $baseLocaleCID);
                                    $a->setAreaDisplayName('Gymnasium Icon');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="spa-feature__text">
                                    <?php
                                    $a = new Area('gymnasium_text');
                                    $a->setAreaDisplayName('Gymnasium Text');
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-50 flex-container align-center">
            <?php
            $a = new Area('download_brochure');
            $a->setAreaDisplayName('Download Brochure Button');
            $a->setCustomTemplate('file', 'templates/button_transparent_dark');
            $a->display($c);
            ?>
        </div>
    </div>
    <div class="mt-60 owl-container">
        <?php
        $this->inc('elements/sections/owl_section.php', ['handle' => $section_handle]);
        ?>
    </div>
    <div class="mt-100 mb-80 grid-container">
        <div class="mb-50 user-editable-content user-editable-content_text-center">
            <?php
            $a = new Area('spa_treatments_title');
            $a->setAreaDisplayName('Spa Treatments Title');
            $a->display($c);
            ?>
        </div>
        <div class="grid-x grid-margin-x">
            <?php
            $filterData = [
                'attributes'                 => ['exclude_treatments_list' => '0', 'show_spa_page' => 1],
                'find_in_children'           => true,
                'item_per_page'              => 3
            ];

            $items = $theme->getFilteredPageList($c, $filterData);
            $i = 1;

            foreach ($items as $item) {

                $itemCID = $item->cID;
                $itemBaseLocaleCID = $theme->getPageIDInBaseLocale($itemCID);
                $itemName = $item->getCollectionName();
                $itemShortName = $textHelper->shortText($itemName, 20);
                ?>
                <div class="medium-6 large-4 cell">
                    <div class="card card_popup card_small">
                        <div class="card__image">
                            <?php
                            $a = new GlobalArea('main_image_' . $itemBaseLocaleCID);
                            $a->setCustomTemplate('image', 'templates/accommodation_list');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="card__text">
                            <div class="card__date">
                                <?php
                                $a = new GlobalArea('treatment_price_' . $itemBaseLocaleCID);
                                $a->setCustomTemplate('image', 'templaptes/accommodation_list');
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__title">
                                <p>
                                    <?php
                                    $a = new GlobalArea('page_title_' . $itemCID);
                                    if (!$a->getTotalBlocksInArea()) {

                                        if (!isset($blockTypeText)) {
                                            $blockTypeText = BlockType::getByHandle('text');
                                        }

                                        $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $itemName]);
                                    }
                                    $a->setAreaDisplayName('Page Title ' . $itemShortName);
                                    $a->display($c);
                                    ?>
                                </p>
                            </div>
                            <div class="user-editable-content user-editable-content_text-center user-editable-content_no-p-margins">
                                <?php
                                $a = new GlobalArea('treatment_excerpt_' . $itemCID);
                                $a->setAreaDisplayName('Treatment Excerpt ' . $itemShortName);
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
        <div class="mt-30 flex-container align-center">
            <?php
            $a = new Area('all_treatments_link');
            $a->setAreaDisplayName('All Treatments Link');
            $a->display($c);
            ?>
        </div>
    </div>
    <section class="two-halves two-halves_bg-none two-halves_border-thin">
        <div class="two-halves__layer align-self-top">
            <div class="emblem"><i class="icon-emblem-richemond"></i></div>
        </div>
        <div class="two-halves__layer">
            <div class="grid-x">
                <div class="large-6 large-offset-6 cell">
                    <?php
                    $a = new GlobalArea('fitness_image_spa');
                    $a->setAreaDisplayName("Fitness Image SPA");
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
                                    $a = new GlobalArea('fitness_color_icon');
                                    $a->setAreaDisplayName("Fitness Color Icon");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__top">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area('fitness_title');
                                        $a->setAreaDisplayName("Fitness Title");
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="line-x"></div>
                                <div class="user-editable-content mb-20">
                                    <?php
                                    $a = new Area('fitness_text');
                                    $a->setAreaDisplayName("Fitness Text");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="accordeons">
                                    <div class="accordeon">
                                        <?php
                                        $a = new Area('membership_benefits_text');
                                        $a->setAreaDisplayName("Membership Benefits Text");
                                        if ($c->isEditMode()) {
                                            echo '<span style="margin: 30px 0 15px 0">down</span>';
                                            $a->display($c);
                                        }
                                        ?>
                                        <div class="accordeon__head">
                                            <?php
                                            if (!$c->isEditMode()) {
                                                $a->display($c);
                                            } ?>
                                        </div>
                                        <div class="accordeon__dropdown">
                                            <div class="accordeon__html">
                                                <div class="user-editable-content">
                                                    <?php
                                                    $a = new Area('membership_benefits_accordeon_text');
                                                    $a->setAreaDisplayName("Membership Benefits Accordeon Text");
                                                    $a->display($c);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordeon">
                                        <?php
                                        $a = new Area('membership_rates_text');
                                        $a->setAreaDisplayName("Membership Rates Text");
                                        if ($c->isEditMode()) {
                                            echo '<span style="margin: 30px 0 15px 0">down</span>';
                                            $a->display($c);
                                        }
                                        ?>
                                        <div class="accordeon__head">
                                            <?php
                                            if (!$c->isEditMode()) {
                                                $a->display($c);
                                            } ?>
                                        </div>
                                        <div class="accordeon__dropdown">
                                            <div class="accordeon__html">
                                                <div class="user-editable-content">
                                                    <?php
                                                    $a = new Area('membership_rates_accordeon_text');
                                                    $a->setAreaDisplayName("Membership Rates Accordeon Text");
                                                    $a->display($c);
                                                    ?>
                                                    <p>
                                                        <?php
                                                        $a = new GlobalArea('spa_email_link');
                                                        $a->setAreaDisplayName('SPA Email Link');
                                                        $a->display($c);
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $a = new GlobalArea('spa_phone_link');
                                                        $a->setAreaDisplayName('SPA Phone Link');
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-80">
        <?php
        $this->inc('elements/sections/3_column_bottom_info.php', ['handle' => $section_handle]);
        ?>
    </div>
    <section class="highlights">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-8 large-offset-2 cell">
                    <div class="layers">
                        <div class="emblem mt-100 mb-125 o-5"><i class="icon-emblem-richemond"></i></div>
                        <div class="o-95">
                            <div class="user-editable-content user-editable-content_text-center mb-40">
                                <?php
                                $a = new Area('bottom_text_title');
                                $a->setAreaDisplayName("Bottom Text Title");
                                $a->display($c);
                                ?>
                            </div>
                            <div class="line-x"></div>
                            <div class="user-editable-content user-editable-content_two-columns user-editable-content_ul-disk o-60 mt-55">
                                <?php
                                $a = new Area('bottom_text');
                                $a->setAreaDisplayName("Bottom Text");
                                $a->display($c);
                                ?>
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
