import '../styles/main.scss';
import loadFonts from './utils/load-fonts';
import './widgets/prevent-mobile-scrollbar';
import anime from 'animejs'
import {easing, duration, clipDuration, minSettimeout} from './animation-settings';
import maps from './maps';
import './widgets/whitesquare-form';
import 'owl.carousel';
import initTabs from './tabs';
import {initScrollbar, initPreloader} from './animations';
import isMicrosoft from './utils/detect-microsoft';
import Tooltip from 'tether-tooltip';
import conditionListener from './utils/condition-listener';
import imagesLoaded from 'imagesloaded';
import isMobile from './utils/detect-mobile';
import isFirefox from './utils/detect-firefox';
import './utils/custom-event-polyfill';

function openClipable(element, isOpened) {
    if (isMicrosoft) {
        if (isOpened) {
            setTimeout(() => element.style.display = 'block', 50);
            setTimeout(() => element.style.display = '', 100);
            element.classList.add('opened', isOpened);
        } else {
            element.classList.remove('opened', isOpened);
        }
    } else if (isOpened) {
        if (element.timeout) {
            clearTimeout(element.timeout);
            delete element.timeout;
        }
        element.classList.add('opened');
        setTimeout(() => {
            element.classList.add('clipped');
        }, 20);
    } else {
        element.classList.remove('clipped');
        element.timeout = setTimeout(() => {
            element.classList.remove('opened');
            delete element.timeout;
        }, clipDuration);
    }
}

document.addEventListener('DOMContentLoaded', () => {

  loadFonts(['Prata:400:latin', 'Muli:300,400,600:latin']);

      if (isFirefox) {
          document.documentElement.classList.add('firefox');
      } else {
          initPreloader();
      }

      Array.from(document.querySelectorAll('img')).forEach(el => {
          el.setAttribute('draggable', false);
          el.ondragstart = e => false;
      });

      // accordeons
      (() => {
          const $accordeons = $('.accordeon');
          $accordeons.toArray().forEach(el => {
              const head = el.querySelector('.accordeon__head'),
                  dropdown = el.querySelector('.accordeon__dropdown');
              if (head) {
                  head.innerHTML += '<div class="accordeon__arrow"><i class="icon-dropdown-arrow"></i></div>'
              }
              let opened = false;
              el.addEventListener('click', e => {
                  if (e.target.tagName === 'A') return;
                  el.dispatchEvent(new CustomEvent('toggle', {detail: !opened}));
                  $accordeons.not(el).toArray().forEach(el => {
                      el.dispatchEvent(new CustomEvent('toggle'));
                  })
              });
              el.addEventListener('toggle', e => {
                  const oldOpened = opened;
                  opened = e.detail || false;
                  if (oldOpened !== opened) {
                      toggle();
                  }
              });
              function toggle() {
                  const height = +opened * dropdown.scrollHeight;
                  if (opened) {
                      el.classList.add('opened');
                  } else {
                      el.classList.remove('opened');
                  }
                  dropdown.style.height = `${height}px`;
              }

              toggle(false);
          });
          document.body.addEventListener('click', e => {
              const $accordeon = $(e.target).closest($accordeons);
              $accordeons.not($accordeon).toArray().forEach(el => {
                  el.dispatchEvent(new CustomEvent('toggle'));
              })
          })
      })();

      // freeze height
      Array.from(document.querySelectorAll('.freeze-height')).forEach(el => el.style.height = `${el.clientHeight}px`);

      // search in header
      (() => {
          const search = document.querySelector('.search');

          if (!search) return;

          const input = search.querySelector('.search-form__input');
          let opened = false;

          function update(newOpened) {
              opened = newOpened;
              openClipable(search, newOpened);
          }

          document.querySelector('.icon-search').addEventListener('click', () => {
              update(true);
              input.focus();
          });
          document.body.addEventListener('keyup', e => {
              if (e.keyCode === 27) {
                  update(false);
              }
          });
          document.body.addEventListener('click', e => {
              if (!$(e.target).closest('.search-form, .icon-search').length) {
                  update(false);
              }
          });
      })();

      // header foldable menu
      (() => {
          const header = document.querySelector('.header'),
              headerFold = document.querySelector('.header-fold'),
              a = Array.from(headerFold.querySelectorAll('.header-fold__nav a')),
              socialA = Array.from(headerFold.querySelectorAll('.social a'))
          ;

          let opened = false;

          if (!headerFold) return;

          function update(newOpened) {
              opened = newOpened;
              $(header).toggleClass('opened', newOpened);
              openClipable(headerFold, opened);
              if (!isMobile) {
                  a.forEach((a, i) => {
                      setTimeout(() => {
                          a.style.transform = `translateY(${opened ? 0 : '100%'}) translateZ(0)`;
                      }, !opened ? minSettimeout : window.innerWidth < 641 ? i * 50 : Math.floor(i / 3) * 300);
                  });
                  socialA.forEach((bottomA, i) => {
                      setTimeout(() => {
                          bottomA.style.transform = `translateY(${opened ? 0 : '100%'}) translateZ(0)`;
                      }, !opened ? minSettimeout : (a.length + i) * 100);
                  });
              }
          }

          const hamburger = document.querySelector('.hamburger');
          if (hamburger) {
              hamburger.addEventListener('click', () => {
                  update(!opened);
              });
          }
          if (isMobile) {
              a.forEach(a => a.style.transform = 'none');
              socialA.forEach(a => a.style.transform = 'none');
          }

          document.body.addEventListener('click', e => {
              if (!$(e.target).closest('.header').length) {
                  update(false);
              }
          });
          document.body.addEventListener('keyup', e => {
              if (e.keyCode === 27) {
                  update(false);
              }
          })
      })();

      // lang switcher
      (() => {
          const langSwitcher = document.querySelector('.lang-switcher');

          if (!langSwitcher) return;

          const ul = langSwitcher.children[0];

          if (!ul) return;

          const items = Array.from(ul.children);
          let active = items.filter(el => el.className.includes('active'))[0];
          langSwitcher.addEventListener('mouseenter', () => langSwitcher.classList.add('opened'));
          langSwitcher.addEventListener('mouseleave', () => langSwitcher.classList.remove('opened'));
          langSwitcher.addEventListener('touchend', e => {
              e.stopPropagation();
              langSwitcher.classList.add('opened')
          });
          items.forEach(el => {
              el.addEventListener('click', e => {
                  if (el === active) return;
                  if (active) {
                      active.classList.remove('active');
                  }
                  active = el;
                  active.classList.add('active');
                  langSwitcher.classList.remove('opened');
              })
          });
          document.body.addEventListener('click', e => {
              if (!$(e.target).closest(langSwitcher).length) {
                  langSwitcher.classList.remove('opened');
              }
          });

          // responsive lang switcher
          (() => {
              const container = document.querySelector('.header-fold .grid-container');
              conditionListener(() => window.innerWidth < 641, () => {
                  container.innerHTML = langSwitcher.outerHTML + container.innerHTML;
              }, () => {
                  const mobileLangSwitcher = container.querySelector('.lang-switcher');
                  if (mobileLangSwitcher) {
                      container.removeChild(mobileLangSwitcher);
                  }
              });
          })();
      })();

      // google maps
      maps({maps: document.querySelectorAll('.map'), key: 'AIzaSyA6MiA6NGgxfn0T_5FzSWYHqHdlqiV-0Qk'});

      $('.contact-form').whitesquareForm({
          captchaKey: "6LepjDUUAAAAAJnyT-KnxjrAt0GeTGQhSi2VRTxm",
          liveValidation: true,
          doAjax: true,
          fromUrl: true,
          fromUrlInputName: "from_url",
          minProgressDuration: 500
      }).on('progressEnd', () => {
          const dialog = document.querySelector('.dialog'),
              $copy = $(dialog).clone(),
              $button = $copy.find('.button');
              $copy.appendTo(document.body);
              openClipable($copy[0], true);
              $button.click(() => {
                openClipable($copy[0], false);
                setTimeout(() => $copy.remove(), 1100);
              });
      });

      $('.owl-carousel').each(function () {
          const $self = $(this),
              data = $self.data();
          $self.imagesLoaded(() => {
              $self.owlCarousel(Object.assign({}, {
                  autoHeight: true,
                  loop: true,
                  navText: [
                      '<i class="icon-arrow-up"></i>',
                      '<i class="icon-arrow-up"></i>'
                  ],
                  smartSpeed: duration,
                  margin: 30,
                  responsive: {
                      0: {
                          items: 1,
                          stagePadding: data.items === 3 ? 30 : 0
                      },
                      640: {
                          items: (data.items && data.items !== 3) ? data.items : 1,
                          stagePadding: data.items === 3 ? 175 : 0
                      },
                      800: {
                          items: data.items || 1,
                          stagePadding: 0
                      }
                  }
              }, data));
          });
      });

      $('.treatments_book_button').on('click', function () {
          let   dataCount = $(this).data('count')
              , $treatmentsInputBlock = $('.treatments_input')
              , $selectItem = $treatmentsInputBlock.find('.dropdown__dropdown ul li:nth-child(' + dataCount + ')')
              , $selectItemValue = $selectItem.text();

          $treatmentsInputBlock.find('input[type="text"]').val($selectItemValue);
          $treatmentsInputBlock.find('.dropdown__dropdown ul li').removeClass('active');
          $selectItem.addClass('active');
      });

      $('.offers_book_button').on('click', function () {
          let   dataCount = $(this).data('count')
              , $treatmentsInputBlock = $('.offers_input')
              , $selectItem = $treatmentsInputBlock.find('.dropdown__dropdown ul li:nth-child(' + dataCount + ')')
              , $selectItemValue = $selectItem.text();

          $treatmentsInputBlock.find('input[type="text"]').val($selectItemValue);
          $treatmentsInputBlock.find('.dropdown__dropdown ul li').removeClass('active');
          $selectItem.addClass('active');
      });


      $('.newsletter').on('submit', function (e) {
          e.preventDefault();
          let action = $(this).attr('action'),
              formSelector = $(this).attr('class');

          $.post(action, $(this).serialize()).done(
              function(data) {
                  console.log(data);
              }
          );

          $('.' + formSelector).resetForm();

      });

      initTabs();

      Array.from(document.querySelectorAll('.toggleable-layers')).forEach(widget => {
          const toggles = Array.from(widget.querySelectorAll('.toggleable-layers__toggles > ul > li')),
              layers = Array.from(widget.querySelector('.toggleable-layers__layers').children);

          let activeIndex;

          layers.forEach(el => {
              el.style.opacity = 0;
              el.style.pointerEvents = 'none';
          });

          toggles.forEach(el => el.addEventListener('click', () => toggle(toggles.indexOf(el))));

          toggle(0);

          function toggle(newActiveIndex) {
              if (activeIndex != null) {
                  toggles[activeIndex].classList.remove('active');
                  layers[activeIndex].style.pointerEvents = 'none';
                  anime({
                      targets: layers[activeIndex],
                      opacity: 0,
                      easing: easing,
                      duration: duration
                  })
              }
              activeIndex = newActiveIndex;
              toggles[activeIndex].classList.add('active');
              anime({
                  targets: layers[activeIndex],
                  opacity: 1,
                  easing: easing,
                  duration: duration,
                  complete: () => {
                      layers[activeIndex].style.pointerEvents = 'auto';
                  }
              })
          }
      });

      Array.from(document.querySelectorAll('.card_popup')).forEach(widget => {
          const text = widget.querySelector('.card__text');
          widget.addEventListener('mouseenter', () => {
              widget.classList.add('hover');
              text.style.transform = `translateY(${widget.clientHeight - text.offsetTop - text.scrollHeight}px) translateZ(0)`;
          });
          widget.addEventListener('mouseleave', () => {
              widget.classList.remove('hover');
              text.style.transform = `translateY(0) translateZ(0)`;
          });
          window.addEventListener('resize.horizontal', () => {
              widget.classList.remove('hover');
              text.style.transform = `translateY(0) translateZ(0)`;
          });
      });

      // adding mirror clip effect on cover image or video
      (() => {

          if (isMicrosoft) {
              const video = document.querySelector('.cover__video video');
              if (video) {
                  video.style.opacity = 0;
                  video.muted = true;
                  video.loop = true;
                  video.addEventListener('canplaythrough', () => {
                      video.play();
                      anime({
                          targets: video,
                          opacity: 1,
                          easing: easing,
                          duration: duration
                      });
                  });
              }
              return;
          }

          const coverImageAndVideo = document.querySelectorAll('.cover__video, .cover__image'),
              clipPathId = (coverImageAndVideo && coverImageAndVideo.length && coverImageAndVideo[0].dataset['clipPathId'])
            || 'emblem-richemond',
            clipPath = document.getElementById(clipPathId);

          if (!coverImageAndVideo.length) return;

          const defs = document.querySelector('.defs defs'),
              clipPathForCover = document.createElementNS('http://www.w3.org/2000/svg', 'clipPath');
          clipPathForCover.innerHTML = clipPath.innerHTML;
          clipPathForCover.id = 'emblem-richemond-for-cover';
          defs.appendChild(clipPathForCover);

          _centerClipPath();
          window.addEventListener('resize', _centerClipPath);
          function _centerClipPath() {
              const clipSize = 760,
                  scale = Math.min(window.innerWidth / clipSize, .9);
              clipPathForCover.setAttribute('transform', `scale(${scale}) translate(
                          ${.57 * (coverImageAndVideo[0].clientWidth - clipSize * scale) + 30}, 
                          ${.5 * (coverImageAndVideo[0].clientHeight - clipSize * scale) + 40}
                      )`);
          }

          Array.from(coverImageAndVideo).forEach(el => {
              const original = el.querySelector('img, video');

              $(el).after(`
                  <div class="cover__effect">
                      ${original.outerHTML}
                  </div>
              `);

              let player, playerVideo;
              if (original.tagName === 'VIDEO') {
                  const play = document.querySelector('.play');
                  player = document.createElement('div');
                  player.className = 'player search';
                  player.innerHTML = original.outerHTML + '<button class="search__close"><i class="icon-close"></i></button>';
                  document.body.appendChild(player);
                  play.addEventListener('click', () => {
                      const closeButton = player.querySelector('button');
                      playerVideo = player.querySelector('video');
                      document.documentElement.classList.add('playing');
                      openClipable(player, true);
                      playerVideo.style.opacity = 0;
                      playerVideo.play();
                      setTimeout(() => {
                          playerVideo.style.opacity = 1;
                      }, clipDuration);
                      closeButton.addEventListener('click', () => {
                          playerVideo.pause();
                          playerVideo.currentTime = 0;
                          closeVideo();
                      });
                      playerVideo.addEventListener('webkitendfullscreen', closeVideo);
                      playerVideo.addEventListener('ended', closeVideo);
                      function closeVideo() {
                          openClipable(player, false);
                          playerVideo.style.opacity = 0;
                          setTimeout(() => {
                              document.documentElement.classList.remove('playing');
                          }, clipDuration);
                      }
                  });
              }

              conditionListener(() => window.innerWidth < 641 || window.innerHeight < 481, () => {
                  if (original.tagName === 'VIDEO') {
                      original.style.opacity = 0;
                  }
              }, () => {
                  if (player) {
                      openClipable(player, false);
                      document.documentElement.classList.remove('playing');
                  }
                  if (playerVideo) {
                      playerVideo.pause();
                      playerVideo.currentTime = 0;
                  }
                  // sync start videos
                  if (original.tagName === 'VIDEO') {
                      const twoVideos = [original, document.querySelector('.cover__effect video')];
                      twoVideos.forEach(el => {
                          el.style.opacity = 0;
                          _tryPlayingTwoVideos();
                          el.addEventListener('canplaythrough', () => {
                              el.canplaythrough = true;
                              _tryPlayingTwoVideos();
                          });
                          function _tryPlayingTwoVideos() {
                              if (twoVideos.reduce((prev, curr) => curr.canplaythrough, true)) {
                                  twoVideos.forEach(v => {
                                      v.loop = true;
                                      v.muted = true;
                                      v.play();
                                      anime({
                                          targets: v,
                                          opacity: 1,
                                          easing: easing,
                                          duration: duration
                                      })
                                  });
                              }
                          }
                      });
                  }
              });
          });
      })();

      initScrollbar();

      // book now and edit booking buttons
      (() => {

          // tooltip for edit booking
          const editBooking = document.querySelector('.edit-booking');
          if (!editBooking) return;
          const {drop} = new Tooltip({
              target: editBooking,
              content: editBooking.dataset.title,
              position: 'bottom center'
          });

          // set initial transform position so that animations will work from first time
          drop.open();
          drop.close();

          // behaviour for small screens
          const buttons = document.querySelector('.header__buttons');
          if (buttons) {
              conditionListener(() => window.innerWidth < 641, () => {
                  let opened = false;
                  buttons.onclick = () => {
                      _toggleDrop(!opened);
                  };
                  document.addEventListener('click', e => {
                      if (!$(e.target).closest(buttons).length) {
                          _toggleDrop(false);
                      }
                  });
                  function _toggleDrop(newOpened) {
                      opened = newOpened;
                      $(buttons).toggleClass('opened', opened);
                      if (opened) {
                          setTimeout(() => {
                              drop.open();
                          }, 400);
                      } else {
                          drop.close();
                      }
                  }
              }, () => {
                  drop.open();
                  drop.close();
                  delete buttons.onclick;
              })
          }
      })();

      // gallery
      if (!document.documentElement.className.includes('ccm-edit-mode')) {

          Array.prototype.forEach.call(document.querySelectorAll('.gallery'), gallery => {

              const toggle = gallery.querySelector('.gallery__toggle'),
                  close = gallery.querySelector('.gallery__close'),
                  popup = gallery.querySelector('.gallery__popup'),
                  $carousel = $(popup).find('ul');

              toggle.addEventListener('click', () => {
                  popup.style.opacity = 0;
                  document.body.appendChild(popup);
                  anime({
                      targets: popup,
                      opacity: 1,
                      duration: 600,
                      easing: easing
                  });
                  $carousel.addClass('owl-carousel').owlCarousel({
                      center: true,
                      items: 1,
                      lazyLoad: true,
                      loop: true,
                      margin: 15,
                      nav: true,
                      navText: [
                          '<i class="icon-arrow-pagination"></i>',
                          '<i class="icon-arrow-pagination"></i>'
                      ],
                      smartSpeed: duration,
                      stagePadding: 45
                  });
              });

              close.addEventListener('click', () => {
                  anime({
                      targets: popup,
                      opacity: 0,
                      duration: 600,
                      easing: easing,
                      complete: () => {
                          $carousel.trigger('destroy.owl.carousel');
                          gallery.appendChild(popup);
                      }
                  });
              });

              $carousel.find('img').addClass('owl-lazy');

          });

      } else {
          Array.prototype.forEach.call(document.querySelectorAll('.gallery img'), img => {
              if (img.dataset && img.dataset.src) {
                  img.src = img.dataset.src;
              }
          });
      }

      // buttons
      $('.button').each((i, el) => {
          el.innerHTML = `<div class="button__bg"></div><span class="button__text">${el.innerHTML}</span>`;
      });

      // file inputs
      $('.input-file').each((i, el) => {
          const input = el.querySelector('[data-role="input"]');
          const uploaded = el.querySelector('[data-role="uploaded"]');
          const nameField = el.querySelector('[data-role="name"]');

          if (!input || !uploaded || !nameField) return;

          uploaded.style.display = 'none';

          input.addEventListener('change', e => {
              const [file] = e.target.files;

              if (file) {
                  let {name} = file;
                  nameField.innerHTML = name;
                  uploaded.style.display = '';
              }
          })
      })
});
