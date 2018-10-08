<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c        \Concrete\Core\Page\Page
 * @var $theme    \Application\Theme\Richemond\PageTheme
 * @var $feature \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$dateHelper = Core::make('helper/date');
$langCode = $theme->getLanguageCode();
$section_handle = 'career';

$scheduleType = $c->getAttribute('schedule');
$schedule = $scheduleType->getSelectedOptions()[0];

$jobCategoryType = $c->getAttribute('job_category');
$jobCategory = $scheduleType->getSelectedOptions()[0];

$this->inc('elements/header_top.php');
$this->inc('elements/header.php'); ?>

    <section class="plate mt-120">
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
                                <div class="pt-40">
                                    <div class="grid-x grid-margin-x">
                                    	<!--
                                        <div class="medium-4 cell">
                                            <div class="user-editable-content user-editable-content_no-p-margins">
                                                <?php
                                                $a = new GlobalArea('posting_date_text_' . $langCode);
                                                $a->setAreaDisplayName('Posting Date Text');
                                                $a->display($c);
                                                ?>
                                                <p><?php echo $dateHelper->formatCustom('M d, Y', $c->getCollectionDatePublic()); ?></p>
                                            </div>
                                        </div>
                                    -->
                                        <div class="medium-4 cell">
                                            <div class="user-editable-content user-editable-content_no-p-margins">
                                                <?php
                                                $a = new GlobalArea('schedule_text_' . $langCode);
                                                $a->setAreaDisplayName('Schedule Text');
                                                $a->display($c);
                                                ?>
                                                <p><?php echo $schedule; ?></p>
                                            </div>
                                        </div>
                                        <div class="medium-4 cell">
                                            <div class="user-editable-content user-editable-content_no-p-margins">
                                                <?php
                                                $a = new GlobalArea('job_category_text_' . $langCode);
                                                $a->setAreaDisplayName('Schedule Text');
                                                $a->display($c);
                                                ?>
                                                <p><?php echo $jobCategory; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-60 flex-container align-right">
                                    <?php
                                        $applyNowTextArea = new GlobalArea('apply_now_text_' . $langCode);
                                        $applyNowTextArea->setAreaDisplayName('Apply Now Text');

                                        $theme->renderEditableAreaWrapperStart('#form', ["class" => "button button_light", "data-count" => $i]);
                                            $applyNowTextArea->display($c);
                                        $theme->renderEditableAreaWrapperEnd();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-60 mb-90 grid-container">
        <div class="grid-x">
            <div class="medium-8 medium-offset-2">
                <div class="user-editable-content">
                    <?php
                    $a = new Area('main_content');
                    $a->setAreaDisplayName('Main Content');
                    $a->setCustomTemplate('image_slider', 'templates/article_content_slider');
                    $a->setCustomTemplate('image', 'templates/article_content');
                    $a->setCustomTemplate('text', 'templates/article_blockquote');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <section class="plate plate_contact-form mb-100" id="form">
        <?php
        $this->inc('elements/sections/contact_form.php', ['handle' => $section_handle]);
        ?>
    </section>

<?php
$this->inc('elements/sections/success_message.php', ['handle' => $section_handle . '_' . $langCode]);
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');