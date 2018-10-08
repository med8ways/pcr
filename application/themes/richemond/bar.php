<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$section_handle = 'bar';
$langCode = $theme->getLanguageCode();

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php');
$this->inc('elements/sections/section_intro.php', ['handle' => $section_handle]); ?>

    <div class="mt-40 owl-container">
        <?php
        $this->inc('elements/sections/owl_section.php', ['handle' => $section_handle]);
        ?>
    </div>
    <section class="plate plate_contact-form mt-85 mb-100">
        <div class="grid-container">
            <div class="plate__white">
                <div class="plate__content pt-80 pb-70">
                    <div class="grid-x">
                        <div class="medium-10 medium-offset-1 cell">
                            <div class="user-editable-content user-editable-content_text-center">
                                <?php
                                $a = new Area('table_reservation_title');
                                $a->setAreaDisplayName('Table Reservation Title');
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $a = new GlobalArea('table_reservation_form');
                    $a->setAreaDisplayName('Table Reservation Form');
                    $a->setCustomTemplate('form', 'templates/bar_table_resrvation');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php
$this->inc('elements/sections/success_message.php', ['handle' => $section_handle . '_' . $langCode]);
$this->inc('elements/sections/3_column_bottom_info.php', ['handle' => $section_handle]);
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
