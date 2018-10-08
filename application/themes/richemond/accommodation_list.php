<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$langCode = $theme->getLanguageCode();
$textHelper = Core::make('helper/text');

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_section_with_video.php'); ?>

    <nav class="tabs-toggles collapsed">

        <?php
        $a = new Area('accommodation_filter');
        $a->setAreaDisplayName('Accommodation Filter');
        $a->setCustomTemplate('page_list', 'templates/accommodation_filter');
        $a->display($c);
        ?>

    </nav>
    <section class="tabs mt-100 mb-50">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="medium-6 cell sizer"></div>
                <?php
                $suiteTypes = $c->getCollectionChildren();

                $viewMoreLinkAttributes = [
                        'externalLinkType'  => 'sitemap_link',
                        'externalLinkText'  => t('View More'),
                        'externalLinkClass' => 'button button_light',
                    ];
                $bookLinkAttributes = [
                    'externalLinkType'  => 'custom_link',
                    'externalLinkText'  => t('Book Now'),
                    'externalLinkClass' => 'button',
                ];
                foreach ($suiteTypes as $suiteType) {

                    if ($suiteType->getNumChildren()) {

                        $suiteTypeName = $suiteType->getCollectionName();
                        $suites = $suiteType->getCollectionChildren();

                        foreach ($suites as $suite) {

                            $suiteBaseLocaleCID = $theme->getPageIDInBaseLocale($suite->cID);
                            $suiteName = $suite->getCollectionName();
                            $suiteShortName = $textHelper->shortText($suiteName, 20); ?>

                            <div class="medium-6 cell" data-tabs="<?php echo $textHelper->slugSafeString($suiteTypeName); ?>">
                                <div class="card">
                                    <div class="card__image">
                                        <?php
                                        $a = new GlobalArea('main_image_' . $suiteBaseLocaleCID);
                                        $a->disableControls();
                                        $a->setCustomTemplate('image', 'templates/accommodation_list');
                                        $a->display($c);
                                        ?>
                                    </div>
                                    <div class="card__text">
                                        <div class="card__date">
                                            <p>
                                                <?php
                                                $a = new GlobalArea('from_text');
                                                $a->setAreaDisplayName('From Text');
                                                $a->display($c);
                                                ?>
                                                <span class="black">
                                                    <?php
                                                    $a = new GlobalArea('start_price_' . $suiteBaseLocaleCID);
                                                    $a->setAreaDisplayName('Start Price ' . $suiteShortName);
                                                    $a->display($c);
                                                    ?>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="card__title">
                                            <p>
                                                <?php
                                                $a = new GlobalArea('page_title_' . $suite->cID);
                                                if (!$a->getTotalBlocksInArea()) {
                                                    if (!isset($blockTypeText)) {
                                                        $blockTypeText = BlockType::getByHandle('text');
                                                    }
                                                    $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $suiteName]);
                                                }
                                                $a->setAreaDisplayName('Page Title ' . $suiteShortName);
                                                $a->display($c);
                                                ?>
                                            </p>
                                        </div>
                                        <div class="user-editable-content user-editable-content_text-center user-editable-content_no-p-margins">
                                            <?php
                                            $a = new GlobalArea('suite_excerpt_' . $suite->cID);
                                            $a->setAreaDisplayName('Suite Excerpt ' . $suiteShortName);
                                            $a->display($c);
                                            ?>
                                        </div>
                                        <div class="card__buttons">
                                            <?php
                                            $a = new Area('suite_buttons_' . $suite->cID);
                                            if (!$a->getTotalBlocksInArea($c)) {
                                                $viewMoreLinkAttributes['externalLinkCID'] = $suite->cID;
                                                $bookLinkAttributes['externalLink'] = '#';

                                                if (!isset($blockTypeExternalLink)) {
                                                    $blockTypeExternalLink = BlockType::getByHandle('external_link');
                                                }

                                                $theme->addBlockToArea($blockTypeExternalLink, $a, $c, $viewMoreLinkAttributes);
                                                $theme->addBlockToArea($blockTypeExternalLink, $a, $c, $bookLinkAttributes);
                                            }
                                            $a->setAreaDisplayName('Start Excerpt ' . $suiteShortName);
                                            $a->display($c);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                    }

                } ?>
            </div>
        </div>
    </section>
<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
