<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var \Concrete\Core\Page\Page $c
 */

$u = new User();
$adminGroup = \Concrete\Core\User\Group\Group::getByName('Administrators');
$isAdministrator = ($u->inGroup($adminGroup) || $u->isSuperUser());
$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$activeLanguage = Localization::activeLanguage(); ?>

<!DOCTYPE html>
<html lang="<?php echo $activeLanguage; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#fff">
    <meta name="application-name" content="le-richemond-hotel">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-icon-180x180.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="le-richemond-hotel">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="msapplication-TileImage" content="mstile-144x144.png">
    <meta name="msapplication-config" content="browserconfig.xml">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $view->getThemePath(); ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $view->getThemePath(); ?>/assets/favicon/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php echo $view->getThemePath(); ?>/assets/favicon/favicon.ico">
    <link rel="apple-touch-startup-image"
          media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-320x460.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-640x920.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-640x1096.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-750x1294.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 414px) and (device-height: 736px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 3)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-1182x2208.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 414px) and (device-height: 736px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 3)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-1242x2148.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-748x1024.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-768x1004.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-1496x2048.png">
    <link rel="apple-touch-startup-image"
          media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
          href="<?php echo $view->getThemePath(); ?>/assets/favicon/apple-touch-startup-image-1536x2008.png">
    <?php

    $pageImgAreaHandle = 'main_image_' . $baseLocaleCID;

    if (!is_null(\Stack::getByName($pageImgAreaHandle))) {

        $a = new GlobalArea($pageImgAreaHandle);
        $a->disableControls();
    $a->setCustomTemplate('image', 'templates/meta_tag_img');
    $a->display($c); ?>

    <meta property="og:description" content="<?php echo $c->getCollectionDescription(); ?>"/>
    <meta property="og:url"
          content="<?php echo ($c->getCollectionPointerExternalLink() != '') ? $c->getCollectionPointerExternalLink() : $c->getCollectionLink(); ?>"/>
    <meta property="og:title" content="<?php echo $c->getCollectionName(); ?>"/>

    <?php
    }
    View::element('header_required', [
        'pageTitle' => isset($pageTitle) ? $pageTitle : '',
    'pageDescription' => isset($pageDescription) ? $pageDescription : '',
    'pageMetaKeywords' => isset($pageMetaKeywords) ? $pageMetaKeywords : ''
    ]); ?>

    <link href="<?php echo $view->getThemePath(); ?>/assets/css/main.css" rel="stylesheet">

    <style>
        #ccm-account-menu {
            position: fixed;
            top: 140px;
            right: 0;
            z-index: 840;
        }
    </style>
</head>
<body>
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PXMGXZR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="<?php echo $c->getPageWrapperClass() ?>">