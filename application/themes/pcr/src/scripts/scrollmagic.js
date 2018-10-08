import { TweenMax } from 'gsap';
import ScrollMagic from 'scrollmagic';
import 'animation.gsap';
import isMobile from '@/scripts/utils/detect-mobile';
// import editMode from '@/scripts/utils/detect-edit-mode';
// import { ROOT_ELEMENT } from './constants';

document.addEventListener('DOMContentLoaded', () => {
  const controller = new ScrollMagic.Controller;

  const $elements = ['.info-box', '.news-list', '.contact-box', '.slider-swipe', '.sub-head', '.header',
    '.detail-item', '.news-article', '.slider-full', '.services-item', '.illustration', '.content__stick',
    '.cover .image-box', '.illustration-bg'];

  $('[data-animation ="fade-left"]').each((i, el) => {
    const tween = TweenMax.fromTo(el, 1, { autoAlpha: 0, x: -60 }, {
      autoAlpha: 1,
      x: 0,
      clearProps: 'all',
    });
    new ScrollMagic.Scene({
      duration: 0,
      reverse: false,
      triggerElement: el,
      triggerHook: 0.9,
    }).setTween(tween)
      .addTo(controller);
  });
  $('[data-animation ="fade-right"]').each((i, el) => {
    const tween = TweenMax.fromTo(el, 1, { autoAlpha: 0, x: 60 }, {
      autoAlpha: 1,
      x: 0,
      clearProps: 'all',
    });
    new ScrollMagic.Scene({
      duration: 0,
      reverse: false,
      triggerElement: el,
      triggerHook: 0.9,
    }).setTween(tween)
      .addTo(controller);
  });
  $('[data-animation="stagger"]').each((i, el) => {
    const tween = TweenMax.staggerFromTo($(el).children(), 1, { autoAlpha: 0, y: 60 }, {
      autoAlpha: 1,
      y: 0,
      clearProps: 'transform, opacity',
    }, 0.2);
    new ScrollMagic.Scene({
      duration: 0,
      reverse: false,
      triggerElement: el,
      triggerHook: 0.9,
    }).setTween(tween)
      .addTo(controller);
  });
  $('[data-animation="stagger-horizontal"]').each((i, el) => {
    const children = $(el).children();

    children.each((i, child) => {
      TweenMax.set(child, { autoAlpha: 0 })
    });
    new ScrollMagic.Scene({
      duration: 0,
      reverse: false,
      triggerElement: el,
      triggerHook: 0.9,
    }).on('start', () => {
      children.each((i, child) => {
        if (i % 2) {
          console.log(child);
          TweenMax.fromTo(child, 1, { autoAlpha: 0, x: -60 }, {
            autoAlpha: 1,
            x: 0,
            clearProps: 'transform, opacity',
          });
        } else {
          console.log(child);
          TweenMax.fromTo(child, 1, { autoAlpha: 0, x: 60 }, {
            autoAlpha: 1,
            x: 0,
            clearProps: 'transform, opacity',
          });
        }
      });
    })
      .addTo(controller);
  });
  $('[data-animation="line"]').each((i, el) => {
    TweenMax.set(el, { scale: 0 });
    const tween = TweenMax.fromTo(el, 1, { scale: 0 }, {
      scale: 1,
      clearProps: 'all',
    });
    new ScrollMagic.Scene({
      duration: 0,
      reverse: false,
      triggerElement: el,
      triggerHook: 0.9,
    }).setTween(tween)
      .addTo(controller);
  });
  $('[data-animation="list"]').each((i, el) => {
    $(el.children).each((k, elem) => {
      const tween = TweenMax.fromTo(elem, 1, { autoAlpha: 0, y: 60 }, {
        autoAlpha: 1,
        y: 0,
        clearProps: 'transform, opacity',
      });
      new ScrollMagic.Scene({
        duration: 0,
        reverse: false,
        triggerElement: elem,
        triggerHook: 'onEnter',
      }).setTween(tween)
        .addTo(controller);
    });
  });
  // parallax
  if (!isMobile()) {
    $('[data-animation="parallax"]:not(.cover-bg-text)').each((i, el) => {
      TweenMax.set(el, { x: -100 });
      const multiplier = 200;
      let top;
      new ScrollMagic.Scene({
        duration: '100%',
        triggerElement: el,
        offset: -50,
      }).on('progress', (event) => {
        top = (event.progress * multiplier) - 100;
        TweenMax.to(el, 0.65, { x: top });
      }).addTo(controller);
    });
    $('[data-animation="parallax-vertical"]:not(.cover-bg-text)').each((i, el) => {
      TweenMax.set(el, { y: -200 });
      const multiplier = 100;
      let top;
      new ScrollMagic.Scene({
        duration: '100%',
        triggerElement: el,
        offset: -50,
      }).on('progress', (event) => {
        top = (event.progress * multiplier) - 200;
        TweenMax.to(el, 0.65, { y: top });
      }).addTo(controller);
    });
  }
});
