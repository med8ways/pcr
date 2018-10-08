<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c        \Concrete\Core\Page\Page
 * @var $theme    \Application\Theme\Richemond\PageTheme
 * @var $feature \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
 */
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$langCode = $theme->getLanguageCode();
$textHelper = Core::make('helper/text');
$pageName = $c->getCollectionName();
$pageShortName = $textHelper->shortText($pageName, 20);
$section_handle = 'suite';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
?>
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
                <div class="medium-10 medium-offset-1">
                    <div class="plate__white">
                        <div class="plate__content">
                            <div class="pt-55 pb-40">
                                <div class="line-y line-y_stick-topleft"></div>
                                <div class="flex-container align-justify align-middle mb-25">
                                    <div class="user-editable-content"></div>
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
                                            $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $pageName]);
                                        }
                                        $a->setAreaDisplayName('Page Title ' . $pageShortName);
                                        $a->display($c);
                                        ?>
                                    </h1>
                                </div>
                                <div class="mt-35 flex-container align-justify align-middle">
                                    <div class="nutshell">
                                        <ul>
                                            <li>
                                                <?php
                                                $a = new GlobalArea('from_text');
                                                $a->setAreaDisplayName('From Text');
                                                $a->display($c);
                                                ?>
                                                <span class="black">
                                                    <?php
                                                    $a = new GlobalArea('start_price_' . $baseLocaleCID);
                                                    $a->setAreaDisplayName('Start Price ' . $pageShortName);
                                                    $a->display($c);
                                                    ?>
                                                </span></li>
                                            <li>
                                                <?php
                                                $a = new GlobalArea('square_text');
                                                $a->setAreaDisplayName('Square Text');
                                                $a->display($c);
                                                ?>
                                                <span class="black">
                                                    <?php
                                                    $a = new GlobalArea('square_metres_' . $baseLocaleCID);
                                                    $a->setAreaDisplayName('Square Metres');
                                                    $a->display($c);
                                                    ?><sup>2</sup> /
                                                    <?php
                                                    $a = new GlobalArea('square_ft_' . $baseLocaleCID);
                                                    $a->setAreaDisplayName('Square ft');
                                                    $a->display($c);
                                                    ?><sup>2</sup></span></li>
                                        </ul>
                                    </div>
                                    <?php
                                    $a = new Area('reservation_button');
                                    $a->setAreaDisplayName('Reservation Button');
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
        <?php
        $this->inc('elements/sections/owl_section.php', ['handle' => $section_handle, 'attributes' => ['data-nav' => 'true', 'data-dots' => 'true']]);
        ?>
    </div>
    <div class="mt-70 grid-container">
        <div class="grid-x grid-margin-x">
            <div class="medium-10 medium-offset-1 cell">
                <div class="pt-60 pb-60 features">

                    <?php
                    $features = $c->getCollectionAttributeValue('suite_features');
                    if ($features) {
                        foreach ($features as $feature) {

                            $featureName = $feature->getSelectAttributeOptionValue();
                            $featureHandle = strtolower($textHelper->slugSafeString($featureName));
                            $featureShortName = $textHelper->shortText($featureName, 20); ?>

                            <div class="feature">
                                <div class="feature__image">

                                    <?php
                                    $a = new GlobalArea('feature_icon_' . $featureHandle);
                                    $a->setAreaDisplayName('Feature Icon ' . $featureShortName);
                                    $a->display($c);
                                    ?>

                                </div>
                                <div class="feature__text">

                                    <?php
                                    $a = new GlobalArea('feature_title_' . $featureHandle . '_' . $langCode);
                                    if (!$a->getTotalBlocksInArea()) {
                                        if (!isset($blockTypeContent)) {
                                            $blockTypeContent = BlockType::getByHandle('content');
                                        }
                                        $theme->addBlockToArea($blockTypeContent, $a, $c, ['content' => '<p>' . $featureName . '</p>']);
                                    }
                                    $a->setAreaDisplayName('Feature Title ' . $featureShortName);
                                    $a->display($c);
                                    ?>

                                </div>
                            </div>

                            <?php
                        }
                    } ?>

                </div>
            </div>
        </div>
    </div>
    <section class="two-halves two-halves_dark two-halves_bg-velvet two-halves_medium two-halves_image-left two-halves_shift-up mb-100">
        <div class="two-halves__layer flex-container align-right">
            <div class="emblem"><i class="icon-emblem-richemond"></i></div>
        </div>
        <div class="two-halves__layer">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="large-8 cell">
                        <?php
                        $a = new GlobalArea('accommodation_services_image');
                        $a->setAreaDisplayName('Accommodation Services Image');
                        $a->setCustomTemplate('image', 'templates/img_dragable_false');
                        $a->setPropertiesFromArray(['linkClasses' => 'two-halves__image_shift-up']);
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="two-halves__layer two-halves__layer_content">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="large-7 large-offset-5 cell">
                        <div class="two-halves__content pb-50">
                            <div class="content-pattern">
                                <div class="line-y line-y_stick-top"></div>
                                <div class="mb-30">
                                    <div class="user-editable-content user-editable-content_h4-is-black user-editable-content_text-center">
                                        <?php
                                        $a = new GlobalArea('accommodation_services_title');
                                        $a->setAreaDisplayName('Accommodation Services Title');
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                                <div class="user-editable-content">
                                    <?php
                                    $a = new GlobalArea('accommodation_services_text');
                                    $a->setAreaDisplayName('Accommodation Services Text');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="mt-20 services">
                                    <ul>
                                        <?php
                                        $a = new GlobalArea('accommodation_services_links');
                                        $a->setAreaDisplayName('Accommodation Services Links');
                                        $a->setCustomTemplate('external_link', 'templates/list_item');
                                        $a->display($c);
                                        ?>
                                    </ul>
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
