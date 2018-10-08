<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$langCode = $theme->getLanguageCode();
$dateHelper = Core::make('helper/date');
$textHelper = Core::make('helper/text');


$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
?>
          <section class="top-block mb-60">
            <div class="grid-container">
              <div class="grid-x">
                <div class="medium-8 medium-offset-2 cell">
                  <div class="line-y"></div>
                  <div class="text-center">
                    <div class="emblem emblem_small emblem_white emblem_collapsed"><i class="icon-emblem-richemond"></i></div>
                  </div>
                  <div class="user-editable-content user-editable-content_text-center">
                      <?php
                      $a = new Area('conciergerie_headlines');
                      $a->setAreaDisplayName('Headlines Text');
                      $a->display($c);
                      ?>
                  </div>
                </div>
              </div>
              <div class="mt-45 grid-x">
                <div class="medium-6 medium-offset-3 cell">
                  <div class="user-editable-content user-editable-content_text-center">
                      <?php
                      $a = new Area('conciergerie_guide_brief');
                      $a->setAreaDisplayName('Brief Text Block');
                      $a->display($c);
                      ?>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <div class="flex-container align-center">
              <?php
              $a = new GlobalArea('newsletter_form');
              $a->setAreaDisplayName('Newsletter Form');
              $a->setCustomTemplate('form', 'templates/newsletter_dark');
              $a->display($c);
              ?>
          </div>
            <div class="mt-80 grid-container">
                <div class="grid-x grid-margin-x">
                    <?php

                    if ($c->getAttribute('items_per_page')) {
                        $itemsPerPage = $c->getAttribute('items_per_page');
                        $paginate = $c->getAttribute('paginate');
                    } else {
                        $itemsPerPage = 6;
                        $paginate = false;
                    }

                    $items = $theme->getFilteredPageList($c, ['item_per_page' => $itemsPerPage, 'paginate' => $paginate]);
                    $i = 1;

                    foreach ($items as $item) {

                        $itemCID = $item->cID;
                        $itemBaseLocaleCID = $theme->getPageIDInBaseLocale($itemCID);
                        $itemName = $item->getCollectionName();
                        $itemShortName = $textHelper->shortText($itemName, 20);
                        ?>
                        <div class="medium-6 cell">
                            <div class="card card_popup card_guide">
                                <div class="card__image">
                                    <?php
                                    $a = new GlobalArea('main_image_' . $itemBaseLocaleCID);
                                    $a->disableControls();
                                    $a->setCustomTemplate('image', 'templates/accommodation_list');
                                    $a->display($c);
                                    ?>
                                </div>
                                <div class="card__text">
                                    <div class="card__date">
                                        <p>
                                            <?php
                                            echo $dateHelper->formatCustom('d M, Y', $c->getAttribute('offer_date_start'));
                                            if ($c->getAttribute('offer_date_end')) {
                                                echo ' ' .  t('to') . ' ';
                                                echo $dateHelper->formatCustom('d M, Y', $c->getAttribute('offer_date_end'));
                                            }
                                            ?>
                                        </p>
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
                                        $a = new GlobalArea('treatment_excerpt_' . $itemCID);
                                        $a->setAreaDisplayName('Treatment Excerpt ' . $itemShortName);
                                        $a->display($c);
                                        ?>
                                    </div>
                                    <div class="card__buttons">
                                        <?php
                                        $a = new Area('discover_more_button_' . $itemCID);
                                        $a->setAreaDisplayName('Discover More');
                                        $a->display($c);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            if ($paginate) {
                $theme->renderPageListPagination();
            } ?>

<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
