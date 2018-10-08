import { TimelineMax } from 'gsap';
import toggleModal from '@/scripts/utils/toggle-modal';
import isMobile from '@/scripts/utils/detect-mobile';

class HeaderNav {
  constructor(options) {
    this.menuSelector = options.menuSelector;
    this.menu = document.querySelector(options.menuSelector);
    this.menuContainerSelector = options.menuContainerSelector;
    this.menuContainer = this.menu.querySelector(this.menuContainerSelector);
    this.menuDropdownSelector = options.menuDropdownSelector;
    this.menuDropdowns = this.menu.querySelectorAll(this.menuDropdownSelector);
    this.dropdownWidth = options.dropdownWidth;
    this.tl = new TimelineMax();
  }

  toggleStatus() {
    const header = document.querySelector('header');
    if (header.classList.contains('opened')) {
      header.classList.remove('opened');
    } else {
      header.classList.add('opened');
    }
    if (document.documentElement.classList.contains('menu-opened')) {
      document.documentElement.classList.remove('menu-opened');
    } else {
      document.documentElement.classList.add('menu-opened');
    }
    return toggleModal(header.classList.contains('opened'), this.menuSelector);
  }

  init() {
    const header = document.querySelector('header');

    document.querySelector('[data-type="hamburger-button"]').addEventListener('click', (e) => {
      this.toggleStatus(e);
    });
    this.menuDropdowns.forEach(el => {
      const childUL = el.querySelector('ul');
      el.addEventListener('click', () => {
        if (el.classList.contains('opened')) {
          el.classList.remove('opened');
          if (!isMobile()) {
            this.tl
              .staggerTo(childUL.children, 0.5, { autoAlpha: 0, x: -30 }, 0.1)
              .to(this.menuContainer, 0.7, { x: 0 });
          }  else {
            this.tl
              .to(childUL, 0.7, { autoAlpha: 0, height: '0'})
              .staggerTo(childUL.children, 0.5, { autoAlpha: 0, x: 30 }, 0.1);
          }
        } else {
          el.classList.add('opened');
          if (!isMobile()) {
            this.tl
              .to(this.menuContainer, 0.7, { x: -this.dropdownWidth })
              .staggerTo(childUL.children, 0.5, { autoAlpha: 1, x: 0 }, 0.1);
          } else {
            this.tl
              .to(childUL, 0.7, { autoAlpha: 1, height: '100%'})
              .staggerTo(childUL.children, 0.5, { autoAlpha: 1, x: 0 }, 0.1);
          }
        }
      });
    });
    // document.addEventListener('click', (e) => {
    //   if (!e.target.closest(this.menuSelector)
    //     && header.classList.contains('opened')) {
    //     this.toggleStatus();
    //   }
    // });
  }
}

export default function initHeaderNav(options) {
  const defaults = {
    menuSelector: '.header__menu',
    menuDropdownSelector: '.has-children',
    menuContainerSelector: 'menu-list',
    dropdownWidth: 500,
  };
  const headerNav = new HeaderNav(Object.assign({}, defaults, options));
  headerNav.init();
}


// import toggleModal from '../utils/toggle-modal';
//
// document.addEventListener('DOMContentLoaded', () => {
//     let header = $('.js-header'),
//         menuBtn = $('.js-menu-btn'),
//         mainMenu = $('.js-main-menu'),
//         headerWrap = $('.header-wrap');
//
//     // scroll
//     (() => {
//         let scroll = window.requestAnimationFrame;
//         function scrollWindow() {
//             let st = $(window).scrollTop();
//             console.log(st);
//             if (st > 15) {
//                 header.addClass('hide-content');
//             } else {
//                 header.removeClass('hide-content');
//             }
//             scroll(scrollWindow);
//         }
//         scrollWindow();
//     })();
//
//     function closeMenu() {
//         // header.removeClass('hide-onclick');
//         menuBtn.removeClass('transform-hamburger');
//         headerWrap.removeClass('show-wrap');
//         mainMenu.removeClass('slide-menu');
//         toggleModal(false, '.header__slide');
//     }
//
//     menuBtn.click( () => {
//         if (menuBtn.hasClass('transform-hamburger')) {
//             closeMenu();
//         } else {
//             // if (!header.hasClass('hide-content')) {
//             //     header.addClass('hide-onclick');
//             // }
//             menuBtn.addClass('transform-hamburger');
//             headerWrap.addClass('show-wrap');
//             mainMenu.addClass('slide-menu');
//             toggleModal(true, '.header__slide');
//         }
//     });
//
//     $(document).on('click', (e) => {
//         if (!$(e.target).closest(menuBtn).length && !$(e.target).closest(mainMenu).length) {
//             closeMenu();
//         }
//     });
// });