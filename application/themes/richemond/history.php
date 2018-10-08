<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 * @var $layoutType \Concrete\Core\Entity\Attribute\Value\Value\SelectValue
 * @var $selected \Concrete\Core\Entity\Attribute\Value\Value\SelectValue
 * @var $layout \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$langCode = $theme->getLanguageCode();

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php'); ?>
    <div class="pt-100 pb-140" id="timeline">
        <div class="grid-container">
            <div class="user-editable-content">
                <?php
                $a = new GlobalArea('image_' . $baseLocaleCID);
                $a->setAreaDisplayName('Image');
                $a->setCustomTemplate('image', 'templates/img_dragable_false');
                $a->display($c);
                ?>
            </div>
            <div class="mt-40 user-editable-content user-editable-content_text-center">
                <?php
                $a = new Area('page_title');
                $a->setAreaDisplayName('Page Title');
                $a->display($c);
                ?>
            </div>
            <div class="mascotte">
                <svg id="Layer_1" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewbox="0 0 215.7 162.6" style="enable-background:new 0 0 215.7 162.6;" xml:space="preserve">
                  <style type="text/css">
                    .st0 {
                        fill: #404A60;
                    }
                    .st1 {
                        fill: #FFFFFF;
                    }
                    .st2 {
                        fill: none;
                    }
                  </style>
                  <g class="paths">
                    <path class="st0"></path>
                    <path class="st0"></path>
                    <path class="st1"></path>
                    <path class="st1"></path>
                    <path class="st2"></path>
                    <path class="st2"></path>
                    <path class="st0"></path>
                    <path class="st0"></path>
                  </g>
                </svg>
            </div>

            <?php
            $handle = 'hotel_history_date';
            $entries = $theme->getEntryListByHandle($handle);

            foreach ($entries as $entry) {

                $entryTitle = $entry->getAttribute($handle . '_title_fr');
                $entryShortTitle = $textHelper->shortText($entryTitle, 20);
                $entryID = $entry->getID();
                $layoutType = $entry->getAttribute($handle . '_layout_type');
                $selected = $layoutType ? $layoutType->getSelectedOptions()[0] : $layoutType;
                $layout = $selected ? $selected->getSelectAttributeOptionDisplayValue() : 'standart';

                $this->inc('elements/sections/timeline-item-' . $layout . '.php', ['entry' => $entry, 'handle' => $handle]);
            } ?>

        </div>
    </div>

<?php
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
