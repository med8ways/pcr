import { TimelineLite, TweenMax } from 'gsap';
import store from 'store';
import toggleScroll from '@/scripts/utils/toggle-body-scroll';
import createEvent from '@/scripts/utils/create-event';
import { ROOT_ELEMENT } from '@/scripts/constants';
// import getElementsArray from '../utils/get-elements-array';

const STORAGE_KEY = 'hasSeenPreloader';
const STORAGE_VALUE = 'true';

window.addEventListener('load', () => {
  store.set(STORAGE_KEY, STORAGE_VALUE);
});

document.addEventListener('DOMContentLoaded', () => {
  const tl = new TimelineLite({ delay: 1 });
  let coverBg;
  let coverItems;

  const cover = document.querySelector('.content__cover');
  if (cover && !cover.classList.contains('is-static')) {
    coverBg = document.querySelector('.content__cover .bg-text');
    coverItems = document.querySelector('.content__cover [data-animation="stagger"]').children;
    TweenMax.set(coverItems, { autoAlpha: 0, willChange: 'transform, opacity', x: -100 });
    TweenMax.set(coverBg, { autoAlpha: 0, willChange: 'transform, opacity', x: 150 });
  }

  toggleScroll(true);
  tl.add(
    TweenMax.to('.preloader .progress', 1.5, {
      scaleX: 1,
      onComplete: () => {
        toggleScroll(false);
      },
    }),
    TweenMax.to('.preloader img', 0.5, { autoAlpha: 1, delay: 1 })
  );

  tl.add(TweenMax.to('.preloader', 0.6, {
    autoAlpha: 0,
  }));

  if (cover && !cover.classList.contains('is-static')) {
    tl.add(
      TweenMax.staggerTo(coverItems, 3, {
        autoAlpha: 1,
        x: 0,
        clearProps: 'all',
      }, 0.2, () => {
        TweenMax.set(coverItems, { willChange: '' });
        ROOT_ELEMENT.dispatchEvent(createEvent('preloaderEnd')); // used in cookies message
      }),
      TweenMax.to(coverBg, 4, {
        autoAlpha: 1,
        x: 0,
        clearProps: 'all',
      }));
  }
});