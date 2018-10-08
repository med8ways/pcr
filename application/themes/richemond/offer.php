<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c        \Concrete\Core\Page\Page
 * @var $theme    \Application\Theme\Richemond\PageTheme
 * @var $feature \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
 */
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$section_handle = 'offer';
$dateHelper = Core::make('helper/date');

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
                            <div class="pt-55 pb-20">
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
                                    <h2>
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
                                    </h2>
                                </div>
                                <div class="mt-35 flex-container align-justify align-middle">
                                    <div class="user-editable-content">
                                        <h4>
                                            <?php
                                            echo $dateHelper->formatCustom('d M Y', $c->getAttribute('offer_date_start'));
                                            if ($c->getAttribute('offer_date_end')) {
                                                echo ' ' .  t('to') . ' ';
                                                echo $dateHelper->formatCustom('d M Y', $c->getAttribute('offer_date_end'));
                                            }
                                            ?>
                                        </h4>
                                    </div>
                                    <?php
                                    $a = new Area('check_availability_button');
                                    $a->setAreaDisplayName('Check Availability Button');
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
    $this->inc('elements/sections/excerpt_main_text.php', ['handle' => $section_handle]);
    ?>
    <div class="mt-90 owl-container">
        <?php $this->inc('elements/sections/owl_section.php', ['handle' => $section_handle, 'attributes' => ['data-nav' => 'true', 'data-dots' => 'true']]); ?>
    </div>
    <div class="mb-100 grid-container">
        <div class="grid-x grid-margin-x">
            <div class="medium-6 cell">
                <div class="user-editable-content user-editable-content_no-p-margins">
                    <?php
                    $a = new GlobalArea('terms_conditions_title');
                    $a->setAreaDisplayName("Terms & Conditionsc Title");
                    $a->display($c);
                    ?>
                    <?php
                    $a = new Area('terms_conditions');
                    $a->setAreaDisplayName("Terms & Conditions");
                    $a->display($c);
                    ?>
                </div>
            </div>
            <div class="medium-6 cell">
                <div class="user-editable-content user-editable-content_no-p-margins">
                    <?php
                    $a = new Area('contact_title');
                    $a->setAreaDisplayName("Contact Title");
                    $a->display($c);
                    ?>
                    <p>
                        <?php
                        $a = new GlobalArea($section_handle . '_email_link');
                        $a->setAreaDisplayName('Email Link');
                        $a->display($c);
                        ?>
                    </p>
                    <p>
                        <?php
                        $a = new GlobalArea($section_handle . '_phone_link');
                        $a->setAreaDisplayName('Phone Link');
                        $a->display($c);
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');