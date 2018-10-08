<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c        \Concrete\Core\Page\Page
 * @var $theme    \Application\Theme\Richemond\PageTheme
 * @var $feature \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
 */
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$section_handle = 'event_space';
$langCode = $theme->getLanguageCode();

$this->inc('elements/header_top.php');
$this->inc('elements/header.php'); ?>

    <section class="top-image">
        <?php
        $a = new GlobalArea('main_image_' . $baseLocaleCID);
        $a->setAreaDisplayName('Main Image');
        $a->setCustomTemplate('image', 'templates/accommodation_detail');
        $a->display($c);
        ?>
    </section>
    <section class="plate">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="medium-10 medium-offset-1 cell">
                    <div class="plate__white">
                        <div class="plate__content">
                            <div class="pt-55 pb-40">
                                <div class="line-y line-y_stick-topleft"></div>
                                <div class="flex-container align-justify align-middle mb-25">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area('up_text');
                                        $a->setAreaDisplayName('Up Text');
                                        $a->display($c);
                                        ?>
                                    </div>
                                    <div class="social o-80">
                                        <?php
                                        $a = new GlobalArea('share_this');
                                        $a->setAreaDisplayName('Social Share');
                                        $a->setCustomTemplate('share_this_page', 'templates/accommodation_detail');
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="user-editable-content">
                                    <h1>
                                        <?php
                                        $a = new GlobalArea('page_title_' . $c->cID);
                                        if (!$a->getTotalBlocksInArea()) {
                                            if (!isset($blockTypeText)) {
                                                $blockTypeText = BlockType::getByHandle('text');
                                            }
                                            $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $c->getCollectionName()]);
                                        }
                                        $a->setAreaDisplayName('Page Title ' . $pageShortName);
                                        $a->display($c);
                                        ?>
                                    </h1>
                                </div>
                                <div class="mt-35 flex-container align-justify align-middle">
                                    <?php
                                    if (!$c->getAttribute('exclude_page_list')) { ?>
                                    <div class="nutshell">
                                        <ul>
                                            <li>
                                                <?php
                                                $a = new GlobalArea('up_to_text');
                                                $a->setAreaDisplayName('Up To Text');
                                                $a->display($c);
                                                ?>
                                                <span class="black">
                                                    <?php
                                                    $a = new Area('guests_num');
                                                    $a->setAreaDisplayName('Number Of Guests');
                                                    $a->display($c);
                                                    ?>
                                                </span>
                                            </li>
                                            <li>
                                                <?php
                                                $a = new GlobalArea('square_text');
                                                $a->setAreaDisplayName('Square Text');
                                                $a->display($c);
                                                ?>
                                                <span class="black">
                                                    <?php
                                                    $a = new Area('square_meter');
                                                    $a->setAreaDisplayName('square meter');
                                                    $a->display($c);
                                                    ?>
                                                    <sup>2</sup>
                                                    (
                                                    <?php
                                                    $a = new Area('square_foot');
                                                    $a->setAreaDisplayName('square Foot');
                                                    $a->display($c);
                                                    ?>
                                                    <sup>2</sup>
                                                    )
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                        <?php
                                        $makeReservationTextArea = new GlobalArea('make_reservation_text');
                                        $makeReservationTextArea->setAreaDisplayName('Make a Reservation Text');

                                        $makeReservationTextAreaAttributes = [
                                            "class" => "button button_light scroll-to-reservation offers_book_button",
                                            "data-count" => $c->getCollectionDisplayOrder(),
                                        ];

                                        $theme->renderEditableAreaWrapperStart('#contact_form', $makeReservationTextAreaAttributes);

                                            $makeReservationTextArea->display($c);

                                        $theme->renderEditableAreaWrapperEnd();

                                    } else {

                                        $a = new Area('reservation_button');
                                        $a->setAreaDisplayName('Reservation Button');
                                        $a->display($c);

                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-60 grid-container">
        <div class="grid-x">
            <div class="medium-8 medium-offset-2 cell">
                <div class="user-editable-content">
                    <?php
                    $a = new GlobalArea($section_handle . '_excerpt_' . $c->cID);
                    $a->setAreaDisplayName('Page Excerpt');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-80 owl-container">
        <?php $this->inc('elements/sections/owl_section.php', ['handle' => $section_handle, 'attributes' => ['data-nav' => 'true', 'data-dots' => 'true']]); ?>
    </div>

<?php
if ($c->getAttribute('exclude_page_list')) {
    $this->inc('elements/sections/2_column_bottom_info.php', ['handle' => $section_handle]);
} else {
    $this->inc('elements/sections/table_section.php', ['handle' => $section_handle]); ?>
    <div class="mt-100 grid-container">
        <div class="flex-container align-center flex-buttons">
            <?php
            $a = new GlobalArea($section_handle . '_buttons');
            $a->setAreaDisplayName('Buttons');
            $a->setCustomTemplate('file', 'templates/button_transparent_dark');
            $a->display($c);
            ?>
            <?php
            $a = new Area('visual_tour_buttons');
            $a->setAreaDisplayName('Visual Tour Buttons');
            $a->display($c);
            ?>
        </div>
        <div class="mt-30 user-editable-content user-editable-content_text-center user-editable-content_do-not-hesitate">
            <h4>
                <?php
                $a = new GlobalArea('hesitate_call_text');
                $a->setAreaDisplayName('Hesitate To Call Text');
                $a->display($c);
                ?>

                <?php
                $a = new GlobalArea('phone_link');
                $a->setAreaDisplayName('Phone Link');
                $a->display($c);
                ?>
            </h4>
        </div>
    </div>
    <section class="plate plate_contact-form mt-70 mb-100" id="contact-form">
        <?php
        $handle = 'event_section'; ?>
        <div class="grid-container">
            <div class="plate__white">
                <div class="plate__content pt-80 pb-70">
                    <div class="grid-x grid-margin-x">
                        <div class="medium-10 medium-offset-1 cell">
                            <div class="user-editable-content user-editable-content_text-center">
                                <?php
                                $a = new GlobalArea('reservation_' . $handle . '_text');
                                $a->setAreaDisplayName('Text');
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $a = new GlobalArea('reservation_' . $handle);
                    $a->setCustomTemplate('form', 'templates/reservation_' . $handle);
                    $a->setAreaDisplayName('Form');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    $this->inc('elements/sections/success_message.php', ['handle' => $section_handle . '_' . $langCode]);
}

$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
