/*
 * In this file, all kinds of initializations that vary from project to project are performed.
 */

import '../styles/main.scss';
import loadFonts from '@/scripts/utils/load-fonts';
import initHeaderNav from '@/scripts/elements/header-nav';
// import './elements/scroll-to-top';
import '@/scripts/elements/preloader';
import '@/scripts/elements/cookies';
import '@/scripts/scrollmagic';
// import './custom-selects';
import '@/scripts/blocks/slider';
import '@/scripts/blocks/contact';
import '@/scripts/blocks/google-map';
import '@/scripts/elements/header-nav';
import '@/scripts/utils/object-fit-fix';
import '@/scripts/parallax';
import '@/scripts/elements/back-to-hp';

document.addEventListener('DOMContentLoaded', () => {
  loadFonts(['Lato:300,400:latin', 'Oswald:200,400,500,700:latin', 'Roboto:900:latin']);
  initHeaderNav({
    menuSelector: '.header__menu',
    menuContainerSelector: '.menu-list',
    menuDropdownSelector: '.has-children',
    dropdownWidth: 500, //dropdown width from style
  });
});
