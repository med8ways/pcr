<?php defined('C5_EXECUTE') or die("Access Denied."); ?>


                </main>
            </div>
        </div>
    </div>
<?php
    $u = new User();
    if (!$u->checkLogin()) { ?>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <?php }

    View::element('footer_required'); ?>

    <script type="text/javascript" src="<?php echo $view->getThemePath(); ?>/assets/js/main.js"></script>
</body>
</html>