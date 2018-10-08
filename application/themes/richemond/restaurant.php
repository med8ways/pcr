<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$langCode = $theme->getLanguageCode();
$section_handle = 'restaurant';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php', ['clipPathId' => 'emblem-jardin']);
$this->inc('elements/sections/section_intro.php', ['handle' => $section_handle, 'emblemIcon' => 'icon-le-jardin']); ?>

    <section class="section section_menu-carousel">
        <div class="grid-container">
            <div class="owl-carousel owl-carousel_offset owl-carousel_buttons-outside" data-items="2">
                <?php
                $handle = 'restaurant_menu';
                $entries = $theme->getEntryListByHandle($handle);

                foreach ($entries as $entry) {

                    $url = false;

                    $entryTitle = $entry->getAttribute($handle . '_title_fr');
                    $entryShortTitle = $textHelper->shortText($entryTitle, 20);
                    $entryID = $entry->getID();

                    $menuFileArea = new GlobalArea($handle . '_menu_file_' . $entryID);
                    $menuFileArea->setAreaDisplayName('File ' . $entryShortTitle);

                    if ($menuFileArea->getTotalBlocksInArea($c)) {

                        $menuFileAreaBlocks = $menuFileArea->getAreaBlocksArray($c);
                        $blockObj = $menuFileAreaBlocks[0];
                        $blockType = $blockObj->getBlockTypeHandle();
                        $blockView = new \Concrete\Core\Block\View\BlockView($blockObj);

                        if ($blockType == 'file') {

                            $fID = $blockView->getScopeItems()['fID'];

                            if ($fID) {
                                $file = \File::getByID($fID);
                                if (is_object($file)) {
                                    $forceDownload = $blockView->getScopeItems()['forceDownload'];
                                    $url = $forceDownload ? $file->getForceDownloadURL() : $file->getDownloadURL();
                                }
                            }
                        }

                        if ($blockType == 'external_link') {
                            $url = $blockObj->getController()->getLink();
                        }

                    }

                    if (!$url) {
                        $url = '#';
                    }

                    $theme->renderEditableAreaWrapperStart($url, ['class '=> 'card-bordered', 'target' => '_blank']); ?>
                        <div class="card-bordered__image">
                            <?php
                            $a = new GlobalArea($handle . '_image_' . $entryID);
                            $a->setAreaDisplayName('Image ' . $entryShortTitle);
                            $a->setCustomTemplate('image', 'templates/restaurant_menu');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="user-editable-content user-editable-content_text-center">
                            <?php
                            $a = new Area($handle . '_title_' . $entryID);
                            if (!$a->getTotalBlocksInArea($c)) {

                                if (!isset($blockTypeContent)) {
                                    $blockTypeContent = BlockType::getByHandle('content');
                                }

                                $theme->addBlockToArea($blockTypeContent, $a, $c, ['content' => '<h3>' . $entryTitle . '</h3>']);
                            }
                            $a->setAreaDisplayName('Title ' . $entryShortTitle);
                            $a->display($c);
                            ?>
                        </div>

                        <?php
                        if ($c->isEditMode()) {
                            $menuFileArea->display($c);
                        }
                        ?>

                    <?php $theme->renderEditableAreaWrapperEnd(); ?>

                <?php } ?>
            </div>
        </div>
    </section>
    <div class="mt-130 grid-container">
        <div class="grid-x">
            <div class="medium-8 medium-offset-2 cell">
                <div class="content-pattern">
                    <div class="text-center">
                        <div class="emblem emblem_small emblem_white emblem_collapsed"><i class="icon-le-jardin"></i></div>
                    </div>
                    <div class="content-pattern__decor">
                        <?php
                        $a = new GlobalArea('dessert_icon');
                        $a->setAreaDisplayName("Dessert icon");
                        $a->display($c);
                        ?>
                    </div>
                    <div class="content-pattern__top">
                        <div class="user-editable-content">
                            <?php
                            $a = new Area('dessert_title');
                            $a->setAreaDisplayName("Dessert Title");
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                    <div class="line-x"></div>
                    <div class="user-editable-content user-editable-content_text-center">
                        <?php
                        $a = new Area('dessert_text');
                        $a->setAreaDisplayName("Dessert Text");
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-60 owl-container">
        <?php
        $this->inc('elements/sections/owl_section.php', ['handle' => $section_handle, 'attributes' => ['data-nav' => 'true', 'data-dots' => 'true']]);
        ?>
    </div>
    <section class="two-halves two-halves_shift-up">
        <div class="two-halves__layer align-self-top">
            <div class="emblem"><i class="icon-le-jardin"></i></div>
        </div>
        <div class="two-halves__layer">
            <div class="grid-x">
                <div class="large-8 large-offset-4 cell">
                    <?php
                    $a = new GlobalArea('vegetarian_menu_image');
                    $a->setAreaDisplayName("Vegetarian Menu Image");
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
                                    $a = new GlobalArea('vegetarian_menu_icon');
                                    $a->setAreaDisplayName("Vegetarian Menu icon");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__top">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area('vegetarian_menu_title');
                                        $a->setAreaDisplayName("Vegetarian Menu Title");
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="line-x"></div>
                                <div class="user-editable-content">
                                    <?php
                                    $a = new Area('vegetarian_menu_text');
                                    $a->setAreaDisplayName("Vegetarian Menu Text");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__buttons flex-container align-justify">
                                    <?php
                                    $a = new Area('vegetarian_menu_buttons');
                                    $a->setAreaDisplayName("Vegetarian Menu Buttons");
                                    $a->setCustomTemplate('file', 'templates/button');
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
    <div class="mt-25 mb-40 grid-container">
        <div class="grid-x grid-margin-x cards-row">
            <?php
            $handle = 'restaurant_hall';
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
                            $a->setCustomTemplate('image', 'templates/accommodation_list');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="card__text">
                            <div class="card__title">
                                <p>
                                    <?php
                                    $a = new Area($handle . '_title_' . $entryID);
                                    if (!$a->getTotalBlocksInArea($c)) {

                                        if (!isset($blockTypeText)) {
                                            $blockTypeText = BlockType::getByHandle('text');
                                        }

                                        $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $entryTitle]);
                                    }
                                    $a->setAreaDisplayName('Title ' . $entryShortTitle);
                                    $a->display($c);
                                    ?>
                                </p>
                            </div>
                            <div class="user-editable-content user-editable-content_text-center user-editable-content_no-p-margins">
                                <?php
                                $a = new GlobalArea($handle . '_excerpt_' . $entryID);
                                $a->setAreaDisplayName('Excerpt ' . $entryShortTitle);
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__buttons">
                                <?php
                                $a = new Area($handle . '_reservation_link_' . $entryID);
                                $a->setAreaDisplayName('Reservation Link ' . $entryShortTitle);
                                $a->display($c);?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

    <div class="mt-65 mb-50 grid-container">
        <div class="grid-x">
            <div class="medium-8 medium-offset-2 cell">
                <div class="content-pattern">
                    <div class="content-pattern__decor">
                        <?php
                        $a = new GlobalArea('restaurant_staff_icon');
                        $a->setAreaDisplayName("Restaurant Staff Icon");
                        $a->display($c);
                        ?>
                    </div>
                    <div class="content-pattern__top">
                        <div class="user-editable-content">
                            <?php
                            $a = new Area('restaurant_staff_title');
                            $a->setAreaDisplayName("Restaurant Staff Title");
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                    <div class="line-x"></div>
                </div>
            </div>
        </div>
        <div class="toggleable-layers">
            <div class="grid-x">
                <div class="medium-10 medium-offset-1 cell">
                    <div class="toggleable-layers__toggles tabs-toggles tabs-toggles_equal">
                        <ul>
                            <li>
                                <?php
                                $a = new Area('stuff_type_chefs');
                                $a->setAreaDisplayName("Staff Type Chefs");
                                $a->display($c);
                                ?>
                            </li>
                            <li>
                                <?php
                                $a = new Area('stuff_type_producers');
                                $a->setAreaDisplayName("Staff Type Producers");
                                $a->display($c);
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-145 toggleable-layers__layers">
                <div class="<?php echo !$c->isEditMode() ? 'owl-carousel' : false; ?> owl-carousel_offset owl-carousel_scalable cards-row" data-items="3" data-dots="false" data-center="true">
                    <?php
                    $a = new Area('stuff_slider_chefs');
                    $a->setAreaDisplayName("Staff Slider Chefs");
                    $a->setCustomTemplate('image_slider', 'templates/staff_slider');
                    $a->display($c);
                    ?>
                </div>
                <div class="<?php echo !$c->isEditMode() ? 'owl-carousel' : false; ?> owl-carousel_offset owl-carousel_scalable cards-row" data-items="3" data-dots="false" data-center="true">
                    <?php
                    $a = new Area('stuff_slider_producers');
                    $a->setAreaDisplayName("Staff Slider Producers");
                    $a->setCustomTemplate('image_slider', 'templates/staff_slider');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
$this->inc('elements/sections/section_intro.php', ['handle' => 'reserve_table_online', 'emblemIcon' => 'icon-le-jardin', 'areaModifier' => 'reservation', "oneColumnContent" => true]);
$this->inc('elements/sections/3_column_bottom_info.php', ['handle' => $section_handle]);
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
