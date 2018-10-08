<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c        \Concrete\Core\Page\Page
 * @var $theme    \Application\Theme\Richemond\PageTheme
 */
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$section_handle = 'offer';
$dateHelper = Core::make('helper/date');
$numCols = 3;

$this->inc('elements/header_top.php');
$this->inc('elements/header.php'); ?>
    <section class="section section_sitemap">
        <div class="container">
            <div class="sitemap">
                <div class="row">
                    <div class="grid-x grid-margin-x flex-container align-justify">

                    <?php
                    for ($col = 1; $col <= $numCols; $col++) {

                        $filterData = [
                            'attributes' => ['sitemap_column' => $col],
                            'filter_by_page_tree_parent' => true,
                        ];

                        $pages = $theme->getFilteredPageList($c, $filterData); ?>
                        <div class="medium-3 small-offset-1 mb-100">
                            <ul>
                                <?php
                                if ($col == 1) {
                                    $localeHomePage = $c->getSiteTreeObject()->getSiteHomePageObject(); ?>
                                    <li>
                                        <a href="<?php echo $localeHomePage->getCollectionLink(); ?>">
                                            <?php echo $localeHomePage->getCollectionName(); ?>
                                        </a>
                                    </li>
                                    <?php
                                }

                                foreach ($pages as $page) { ?>
                                    <li>
                                        <a href="<?php echo $page->getCollectionLink(); ?>">
                                            <?php echo $page->getCollectionName(); ?>
                                        </a>
                                        <?php $theme->generateSitemapLevel($page); ?>
                                    </li>
                                    <?php
                                } ?>
                            </ul>
                        </div>
                        <?php
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
