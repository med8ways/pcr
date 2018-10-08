<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$section_handle = 'spa_treatments';
$langCode = $theme->getLanguageCode();

$this->inc('elements/header_top.php');
$this->inc('elements/header.php'); ?>

    <section class="top-block mb-60">
        <div class="grid-container">
            <?php
            $this->inc('elements/sections/top_block_without_image.php');
            ?>
            <div class="mt-60 tags">
                <?php
                $a = new GlobalArea('label_treatments_nav');
                $a->setAreaDisplayName('Label Treatment nav');
                $a->setCustomTemplate('page_list', 'templates/label_nav_spa');
                $a->display($c);
                ?>
            </div>
        </div>
    </section>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">

            <?php
            $filterData = [
                'attributes'                 => ['exclude_treatments_list' => '0'],
                'find_in_children'           => true,
            ];

            $items = $theme->getFilteredPageList($c, $filterData);
            $i = 1;

            $bookNowTextArea = new GlobalArea('book_now_text');
            $bookNowTextArea->setAreaDisplayName('Book Now Text');

            foreach ($items as $item) {

                $itemCID = $item->cID;
                $itemBaseLocaleCID = $theme->getPageIDInBaseLocale($itemCID);
                $itemName = $item->getCollectionName();
                $itemShortName = $textHelper->shortText($itemName, 20); ?>

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
                            <div class="card__buttons">
                                <?php
                                $theme->renderEditableAreaWrapperStart('#contact_form', ["class" => "button treatments_book_button", "data-count" => $i]);

                                    $bookNowTextArea->display($c);

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
    <section class="plate plate_contact-form mt-35 mb-100" id="contact_form">
        <?php
        $this->inc('elements/sections/contact_form.php', ['handle' => $section_handle]);
        ?>
    </section>
<?php
$this->inc('elements/sections/success_message.php',['handle' => $section_handle . '_' . $langCode]);
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
