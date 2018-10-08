import { TweenMax } from 'gsap';
import store from 'store';
import toggleScroll from '@/scripts/utils/toggle-body-scroll';
import { ROOT_ELEMENT, ROOT_CLASS } from '@/scripts/constants';

const STORAGE_KEY = 'hasConfirmedCookies';
const STORAGE_VALUE = 'true';

document.addEventListener('DOMContentLoaded', () => {
  if (store.get(STORAGE_KEY)) return;

  const cookiesPlaceholder = document.querySelector('.cookies-placeholder');
  const cookies = document.createElement('div');

  cookies.innerHTML = cookiesPlaceholder.innerHTML('');
  cookies.className = 'cookies application';
  document.body.appendChild(cookies);

  function toggleCookiesMessage(isOpened) {
    TweenMax.set(ROOT_ELEMENT, {
      willChange: 'transform',
    });

    ROOT_ELEMENT.classList.toggle(`${ROOT_CLASS}_has-cookies`, isOpened);
    cookies.classList.toggle('cookies_show', isOpened);

    toggleScroll(isOpened);

    setTimeout(() => {
      TweenMax.set(ROOT_ELEMENT, {
        willChange: '',
      });
    }, 700);
  }

  ROOT_ELEMENT.addEventListener('preloaderEnd', () => {
    toggleCookiesMessage(true);
  });

  const button = cookies.querySelector('.button');

  button.addEventListener('click', () => {
    store.set(STORAGE_KEY, STORAGE_VALUE);
    toggleCookiesMessage(false);
  });
});