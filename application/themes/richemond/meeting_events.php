<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$langCode = $theme->getLanguageCode();
$section_handle = 'event_spaces';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php');
$this->inc('elements/sections/section_intro.php', ['handle' => $section_handle]); ?>

    <div class="mt-80 grid-container">
        <div class="grid-x grid-margin-x">
            <?php

            $filterData = [
                'attributes'                 => ['exclude_page_list' => '0'],
            ];

            $items = $theme->getFilteredPageList($c, $filterData);

            $inquiryTextArea = new GlobalArea('Inquiry_text');
            $inquiryTextArea->setAreaDisplayName('Inquiry Text');

            $i = 1;

            foreach ($items as $item) {

                $itemCID = $item->cID;
                $itemBaseLocaleCID = $theme->getPageIDInBaseLocale($itemCID);
                $itemName = $item->getCollectionName();
                $itemShortName = $textHelper->shortText($itemName, 20);
                ?>

                <div class="medium-6 cell">
                    <div class="card card_treatment card_popup">
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
                                $a = new GlobalArea('event_space_num_guests_' . $itemCID);
                                $a->setAreaDisplayName('Number Of Guests ' . $itemShortName);
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
                                $a = new GlobalArea('event_space_excerpt_' . $itemCID);
                                $a->setAreaDisplayName('Event Space Excerpt ' . $itemShortName);
                                $a->display($c);
                                ?>
                            </div>
                            <div class="card__buttons">

                                <?php
                                $a = new Area('buttons_link_' . $itemCID);
                                $a->setAreaDisplayName('Buttons Links ' . $itemShortName);
                                $a->display($c);
                                ?>

                                <?php
                                $theme->renderEditableAreaWrapperStart('#contact_form', ["class" => "button scroll-to-reservation offers_book_button", "data-count" => $i]);

                                    $inquiryTextArea->display($c);

                                $theme->renderEditableAreaWrapperEnd();
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
    </div>
    <?php
    $this->inc('elements/sections/table_section.php', ['handle' => $section_handle]);
    ?>
    <section class="two-halves two-halves_shift-up">
        <div class="two-halves__layer align-self-top">
            <div class="emblem"><i class="icon-emblem-richemond"></i></div>
        </div>
        <div class="two-halves__layer">
            <div class="grid-x grid-margin-x">
                <div class="large-8 large-offset-4 cell">
                    <?php
                    $a = new GlobalArea($section_handle . '_image');
                    $a->setAreaDisplayName("Image");
                    $a->setCustomTemplate('image', 'templates/img_dragable_false');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
        <div class="two-halves__layer two-halves__layer_content">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="large-7 cell">
                        <div class="two-halves__content">
                            <div class="content-pattern">
                                <div class="content-pattern__decor">
                                    <?php
                                    $a = new GlobalArea($section_handle . '_icon');
                                    $a->setAreaDisplayName("Icon");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__top">
                                    <div class="user-editable-content">
                                        <?php
                                        $a = new Area($section_handle . '_title');
                                        $a->setAreaDisplayName("Title");
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="line-x"></div>
                                <div class="user-editable-content user-editable-content_no-p-margins">
                                    <?php
                                    $a = new Area($section_handle . '_text');
                                    $a->setAreaDisplayName("Text");
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="content-pattern__buttons flex-container align-justify">

                                    <?php
                                    $theme->renderEditableAreaWrapperStart('#contact_form', ["class" => "button scroll-to-reservation offers_book_button", "data-count" => $i]);

                                        $a = new Area($section_handle . '_book_table_button');
                                        $a->setAreaDisplayName("Text");
                                        $a->display($c);

                                    $theme->renderEditableAreaWrapperEnd();
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
                                        $a = new GlobalArea('event_section_phone_link');
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
$this->inc('elements/sections/content_image_dark_bg.php'); ?>
    <section class="plate plate_contact-form mt-35 mb-100" id="contact_form">
        <?php
        $this->inc('elements/sections/contact_form.php', ['handle' => 'event_section']);
        ?>
    </section>
<?php
$this->inc('elements/sections/success_message.php', ['handle' => $section_handle . '_' . $langCode]);
$this->inc('elements/sections/2_column_bottom_info.php', ['handle' => $section_handle]);
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
