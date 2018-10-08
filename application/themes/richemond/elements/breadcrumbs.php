<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!---->
<!-- breadcrumbs-->
<!---->
<nav class="breadcrumbs">
    <div class="grid-container">
        <div class="grid-x">
            <?php
            $a = new GlobalArea('breadcrumbs');
            $a->setAreaDisplayName("breadcrumbs");
            $a->setCustomTemplate('autonav', 'templates/breadcrumb.php');
            $a->display($c);
            ?>
        </div>
    </div>
</nav>