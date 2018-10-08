<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 * @var $c     \Concrete\Core\Page\Page
 * @var $theme \Application\Theme\Richemond\PageTheme
 */

$baseLocaleCID = $theme->getPageIDInBaseLocale($c->cID);
$textHelper = Core::make('helper/text');
$langCode = $theme->getLanguageCode();
$section_handle = 'restaurant';

$this->inc('elements/header_top.php');
$this->inc('elements/header.php');
$this->inc('elements/sections/cover_two_buttons.php');
$this->inc('elements/breadcrumbs.php');
$this->inc('elements/footer.php');
$this->inc('elements/footer_bottom.php');
