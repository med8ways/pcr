<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c        \Concrete\Core\Page\Page
 * @var $theme    \Application\Theme\Richemond\PageTheme
 * @var $feature \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$section_handle = 'article';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_section_with_video.php'); ?>


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