import { SCROLL_ELEMENT, SCROLLBAR_PADDING_SELECTORS } from '@/scripts/constants';
import getScrollbarWidth from '@/scripts/utils/scroll-bar-width';

/**
 * Prevent body scroll and overscroll.
 * Tested on mac, iOS chrome / Safari, Android Chrome.
 *
 * Based on: https://benfrain.com/preventing-body-scroll-for-modals-in-ios/
 *           https://stackoverflow.com/a/41601290
 *
 * Use in combination with:
 * html, body {overflow: hidden;}
 *
 * and: -webkit-overflow-scrolling: touch; for the element that should scroll.
 *
 * disableBodyScroll(true, '.i-can-scroll');
 */

/**
 * Private variables
 */
let globalSelector = false;
let globalElement = false;
let globalClientY;

/**
 * Polyfills for Element.matches and Element.closest
 */
if (!Element.prototype.matches) {
  Element.prototype.matches = Element.prototype.msMatchesSelector ||
    Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
  Element.prototype.closest = function (s) {
    let ancestor = this;
    if (!document.documentElement.contains(ancestor)) return null;
    do {
      if (ancestor.matches(s)) return ancestor;
      ancestor = ancestor.parentElement;
    } while (ancestor !== null);
    return ancestor;
  };
}

/**
 * Prevent default unless within _selector
 *
 * @param  event object event
 * @return void
 */
const preventBodyScroll = (event) => {
  if (globalElement === false || !event.target.closest(globalSelector)) {
    event.preventDefault();
  }
};

/**
 * Cache the clientY co-ordinates for
 * comparison
 *
 * @param  event object event
 * @return void
 */
const captureClientY = (event) => {
  // only respond to a single touch
  if (event.targetTouches.length === 1) {
    globalClientY = event.targetTouches[0].clientY;
  }
};

/**
 * Detect whether the element is at the top
 * or the bottom of their scroll and prevent
 * the user from scrolling beyond
 *
 * @param  event object event
 * @return void
 */
const preventOverscroll = (event) => {
  // only respond to a single touch
  if (event.targetTouches.length !== 1) {
    return;
  }

  const clientY = event.targetTouches[0].clientY - globalClientY;

  // The element at the top of its scroll,
  // and the user scrolls down
  if (globalElement.scrollTop === 0 && clientY > 0) {
    event.preventDefault();
  }

  // The element at the bottom of its scroll,
  // and the user scrolls up
  // https://developer.mozilla.org/en-US/docs/Web/API/Element/scrollHeight#Problems_and_solutions
  if ((globalElement.scrollHeight - globalElement.scrollTop <= globalElement.clientHeight) &&
    clientY < 0) {
    event.preventDefault();
  }
};

/**
 * Disable body scroll. Scrolling with the selector is
 * allowed if a selector is porvided.
 *
 * @param allow - boolean
 * @param selector - string - Selector to element to change scroll permission
 * @return void
 */
export default (allow, selector) => {
  if (typeof selector !== 'undefined') {
    globalSelector = selector;
    globalElement = document.querySelector(selector);
  }
  if (allow === true) {
    SCROLL_ELEMENT.style.overflow = 'hidden';
    if (globalElement !== false) {
      globalElement.addEventListener('touchstart', captureClientY, false);
      globalElement.addEventListener('touchmove', preventOverscroll, false);
    }
    SCROLL_ELEMENT.addEventListener('touchmove', preventBodyScroll, false);
  } else {
    SCROLL_ELEMENT.style.overflow = '';
    if (globalElement !== false) {
      globalElement.removeEventListener('touchstart', captureClientY, false);
      globalElement.removeEventListener('touchmove', preventOverscroll, false);
    }
    SCROLL_ELEMENT.removeEventListener('touchmove', preventBodyScroll, false);
  }

  if (SCROLLBAR_PADDING_SELECTORS.length) {
    const scrollbarWidth = getScrollbarWidth();

    SCROLLBAR_PADDING_SELECTORS.forEach((el) => {
      document.querySelector(el).style.marginRight = allow ? `${scrollbarWidth}px` : '';
    });
  }
};
