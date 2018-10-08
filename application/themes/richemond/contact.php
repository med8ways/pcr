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
?>
    <section class="cover">
        <div class="cover__image">
            <?php
            $a = new GlobalArea('main_image_' . $baseLocaleCID);
            $a->setAreaDisplayName('Main Image');
            $a->setCustomTemplate('image', 'templates/img_dragable_false_edit_stub');
            $a->display($c);
            ?>
        </div>
    </section>
    <section class="plate collapsed">
        <div class="grid-container">
            <div class="grid-x">
                <div class="medium-10 medium-offset-1 cell">
                    <div class="plate__white">
                        <div class="plate__content">
                            <div class="pt-75 pb-20">
                                <div class="line-y line-y_stick-topleft"></div>
                                <div class="user-editable-content">
                                    <?php
                                    $a = new Area('contacts_title');
                                    $a->setAreaDisplayName("Contacts Title");
                                    $a->display($c);
                                    ?>
                                </div>
                            </div>
                            <div class="pt-30">
                                <div class="grid-x">
                                    <div class="medium-4 cell">
                                        <div class="user-editable-content user-editable-content_no-p-margins">
                                            <?php
                                            $a = new Area('address_title');
                                            $a->setAreaDisplayName("Address Title");
                                            $a->display($c);
                                            ?>
                                            <?php
                                            $a = new GlobalArea('address');
                                            $a->setAreaDisplayName('Address');
                                            $a->display($c);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="medium-4 cell">
                                        <div class="user-editable-content user-editable-content_no-p-margins">
                                            <?php
                                            $a = new Area('phone_title');
                                            $a->setAreaDisplayName("Phone Title");
                                            $a->display($c);
                                            ?>
                                            <p>
                                                <?php
                                                $a = new GlobalArea('phone_link');
                                                $a->setAreaDisplayName('Phone Link');
                                                $a->display($c);
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="medium-4 cell">
                                        <div class="user-editable-content user-editable-content_no-p-margins">
                                            <?php
                                            $a = new Area('email_title');
                                            $a->setAreaDisplayName("Email Title");
                                            $a->display($c);
                                            ?>
                                            <p>
                                                <?php
                                                $a = new GlobalArea('email_link');
                                                $a->setAreaDisplayName('Email Link');
                                                $a->display($c);
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="plate__bottom mt-40 pt-40 pb-55">
                                <div class="social">
                                    <?php
                                    $a = new GlobalArea('social_links');
                                    $a->setAreaDisplayName('Social Links');
                                    $a->setCustomTemplate('social_links', 'templates/icon_links');
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
    $a = new GlobalArea('contact_map');
    $a->setAreaDisplayName('Contact Map');
    $a->setCustomTemplate('google_map', 'templates/contact_page');
    $a->display($c);
    ?>
    <section class="plate plate_contact-form mt-85 mb-100">
        <div class="grid-container">
            <div class="plate__white">
                <div class="plate__content pt-80 pb-70">
                    <div class="grid-x">
                        <div class="medium-10 medium-offset-1 cell">
                            <div class="user-editable-content user-editable-content_text-center">
                                <?php
                                $a = new Area('contact_form_title');
                                $a->setAreaDisplayName("Contact Form Title");
                                $a->display($c);
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $a = new GlobalArea('contact_us_form');
                    $a->setAreaDisplayName('Contact Us Form');
                    $a->setCustomTemplate('form', 'templates/contact_us');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php
$this->inc('elements/sections/success_message.php', ['handle' => "contact_$langCode"]);
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
