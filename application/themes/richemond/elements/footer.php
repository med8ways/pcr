<?php defined('C5_EXECUTE') or die("Access Denied.");

$u = new User(); ?>

    <footer class="footer">
        <div class="grid-container flex-container flex-dir-column align-middle">
            <div class="footer__logo"><a href=""><img src="<?php echo $view->getThemePath(); ?>/assets/images/icons/richemond-footer.svg" alt></a></div>
            <div class="footer__caption">
                <div class="caption">
                    <div class="user-editable-content user-editable-content_no-p-margins">
                        <?php
                        $a = new GlobalArea('address');
                        $a->setAreaDisplayName('Address');
                        $a->display($c);
                        ?>
                        <p>
                            <?php
                            $a = new GlobalArea('email_link');
                            $a->setAreaDisplayName('Email Link');
                            $a->display($c);
                            ?>
                            <?php
                            $a = new GlobalArea('phone_link');
                            $a->setAreaDisplayName('Phone Link');
                            $a->display($c);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer__social">
                <?php
                $a = new GlobalArea('social_links');
                $a->setAreaDisplayName('Social Links');
                $a->setCustomTemplate('social_links', 'templates/icon_links');
                $a->display($c);
                ?>
            </div>
            <div class="footer__prefer">
                <a href="https://preferredhotels.com/destinations/geneva/le-richemond" target="_blank">
                    <img src="<?php echo $view->getThemePath(); ?>/assets/images/legend-preferred.svg" alt="" draggable="false">
                </a>
                <a href="https://preferredhotels.com/iprefer/enroll?hotel=GVARI" target="_blank">
                    <img src="<?php echo $view->getThemePath(); ?>/assets/images/i-prefer-logo__2jFTz.png" alt="" draggable="false">
                </a>
            </div>
            <nav class="footer__nav align-self-stretch">
                <?php
                $a = new GlobalArea('main_nav');
                $a->setAreaDisplayName('Main Navigation');
                $a->setCustomTemplate('autonav', 'templates/clear_list');
                $a->display($c);
                ?>
            </nav>
            <section class="footer__bottom align-self-stretch <?php echo $u->checkLogin() ? 'style="height: 200px;"' : ''; ?>">
                <div class="grid-x grid-margin-x">
                    <div class="large-5 cell">
                        <div class="flex-container align-justify align-middle">
                            <div class="user-editable-content">
                                <h3>Newsletter</h3>
                            </div>
                            <?php
                            $a = new GlobalArea('newsletter_form');
                            $a->setAreaDisplayName('Newsletter Form');
                            $a->setCustomTemplate('form', 'templates/newsletter');
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                    <div class="large-6 large-offset-1 cell">
                        <div class="flex-container flex-dir-column align-bottom">
                            <nav class="footer__service-nav">
                                <?php
                                $a = new GlobalArea('additional_pages_nav');
                                $a->setAreaDisplayName('Pdditional Pages Navigstion');
                                $a->setCustomTemplate('page_list', 'templates/footer_info_pages');
                                $a->display($c);
                                ?>
                            </nav>
                            <div class="footer__copyright">
                                <p>Copyright © Le Richemond 2017. All rights reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <button class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </button>
    </footer>