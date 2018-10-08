<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c        \Concrete\Core\Page\Page
 * @var $theme    \Application\Theme\Richemond\PageTheme
 * @var $feature \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
 */
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$section_handle = 'article';

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <article class="mt-50 mb-85">
        <div class="grid-container">
            <div class="grid-x">
                <div class="medium-8 medium-offset-2 cell">
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
                    <div class="mt-50 bt pt-30">
                        <div class="flex-container align-justify align-middle small-uppercase">
                            <div class="social">
                                <?php
                                $a = new GlobalArea('share_this');
                                $a->setAreaDisplayName('Social Share');
                                $a->setCustomTemplate('share_this_page', 'templates/accommodation_detail');
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');