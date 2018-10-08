<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c                         \Concrete\Core\Page\Page
 * @var $theme                     \Application\Theme\Richemond\PageTheme
 * @var $pageTopicsBlockController \Application\Block\TopicList\Controller
 * @var $pageTopicsBlockObj        \Concrete\Core\Block\Block
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');

$this->inc('elements/header_top.php');
$this->inc('elements/header.php'); ?>

    <section class="top-block mb-60">
        <div class="grid-container">
            <div class="grid-x">
                <div class="medium-8 medium-offset-2 cell">
                    <div class="line-y"></div>
                    <div class="text-center">
                        <div class="emblem emblem_small emblem_white emblem_collapsed">
                            <i class="icon-emblem-richemond"></i>
                        </div>
                    </div>
                    <div class="user-editable-content user-editable-content_text-center">
                        <?php
                        $a = new Area('cover_uppertext');
                        $a->setAreaDisplayName('Cover Image Uppertext');
                        $a->display($c);
                        ?>
                        <h1>
                            <?php
                            $a = new GlobalArea('page_title_' . $c->cID);
                            if (!$a->getTotalBlocksInArea()) {
                                if (!isset($blockTypeText)) {
                                    $blockTypeText = BlockType::getByHandle('text');
                                }
                                $theme->addBlockToArea($blockTypeText, $a, $c, ['text' => $c->getCollectionName()]);
                            }
                            $a->setAreaDisplayName('Page Title ' . $c->getCollectionName());
                            $a->display($c);
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mb-70 grid-container">
        <div class="grid-x grid-margin-x">
            <?php
            $a = new Area('gallery');
            $a->setAreaDisplayName('Gallery');
            $a->setCustomTemplate('file_sets', 'templates/gallery_page');
            $a->display($c);
            ?>
        </div>
    </div>
<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
