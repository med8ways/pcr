<?php defined('C5_EXECUTE') or die("Access denied") ; 
  /**
  *@var \concrete\core\page\page $c 
  */
Loader::element('header_required'); 
  ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Prestige Car Romand</title>
    <!-- css is appended by HtmlWebpackPlugin automatically here-->
    <!-- favicon is appended by FaviconsWebpackPlugin automatically here-->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#fff">
    <meta name="application-name" content="hevens-webpack">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-icon-180x180.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="hevens-webpack">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="msapplication-TileImage" content="mstile-144x144.png">
    <meta name="msapplication-config" content="browserconfig.xml">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $view->getThemePath() ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $view->getThemePath() ?>/assets/favicon/favicon-16x16.png">
    <link rel="shortcut icon" href="favicon/favicon.ico">
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-320x460.png">
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-640x920.png">
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-640x1096.png">
    <link rel="apple-touch-startup-image" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-750x1294.png">
    <link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 736px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 3)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-1182x2208.png">
    <link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 736px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 3)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-1242x2148.png">
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-748x1024.png">
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-768x1004.png">
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-1496x2048.png">
    <link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" href="<?php echo $view->getThemePath() ?>/assets/favicon/apple-touch-startup-image-1536x2008.png">
    <link href="<?php echo $view->getThemePath() ?>/assets/css/main.css" rel="stylesheet">
  </head>
  
    <div class="application" data-role="root">
      <!-- preloader-->
      <section class="preloader">
        <img src="<?php echo $view->getThemePath() ?>/assets/images/Logo@2x__t0qaS.png" alt="Prestige Car Romand">
        <div class="progress"></div>
      </section>

      <header class="header">
        <div class="grid-container">
          <div class="header__box">
            <div class="header__lang"><a class="active" href="/en">eng</a><a href="/fr">fr</a>
            </div>
            <a class="logo" href="index.html"><img src="<?php echo $view->getThemePath() ?>/assets/images/Logo__3WzsE.png"  draggable="false" alt="logo"></a>
            <div class="header__btn" data-type="hamburger-button">
              <div class="icon-hamburger"><span></span><span></span><span></span></div>
            </div>
          </div>
          <div class="header__menu menu">
            <div class="bg-text">PRESTIGE CAR ROMAND</div>
            <div class="menu-content">
              <div class="grid-x grid-margin-x">
                <div class="large-offset-8 large-4 cell">
                  <div class="menu-list">
                    <ul>
                      <li><a class="menu__item" ">

                      	<?php
                      	$a=new GlobalArea('Header Navigation');
                      	$a->display($c);
                      	?>

                      </a></li>
                  
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="sidebar">
        <div class="social-list"><a href="">
         
          </a><a href="#">twitter</a><a href="#">autoscout24</a>
        </div>
        <div class="sidebar__scroll">
          <div class="sidebar__scroll-line"></div>
          <div class="icon-mouse"></div>
        </div>
      </div>
      <main class="content">
        <!--if sub_head_title-->
        <!--    include elements/sub-head-->
        <div class="content__cover content__lg">
          <div class="sidebar-title">Prestige car romand</div>
          <div class="bg-text bg-text_right bg-text_lighter cover-bg-text" data-animation="parallax">Prestige</div>
          <div class="image-box image-box_cover image-box_top-shadow image-box_btm-shadow" data-animation="parallax">

          	<?php 
          	$a=new GlobalArea('Image header');
          	$a->display($c);
          	?>
         
          </div>
          <div class="grid-container">
            <div class="grid-x grid-margin-x">
              <div class="large-offset-1 large-8 cell">
                <div class="info-box info-box_cover" data-animation="stagger">
                  <div class="info-box__subtitle">   
                  <h1>
                  <?php
                      	$a=new GlobalArea('header_title');
                      	$a->display($c);
                      	?>
                </h1>
                  <div class="info-action"><a class="btn" href="#">
                  	<?php 
                  	$a=new GlobalArea('read more header');
                  	$a->display($c);
                  	?>
                  	<span></span></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </div></main>   
             
    <script type="text/javascript">
      if(/MSIE \d|Trident.*rv:/.test(navigator.userAgent))
        document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.min.js"><\/script>');
      
    </script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- js is appended here by HtmlWebpackPlugin automatically-->
    <script type="text/javascript" src="<?php echo $view->getThemePath() ?>/assets/js/main.js"></script>


<div class="<?php echo $c->getPageWrapperClass() ?>">