import detectMicrosoft from '@/scripts/utils/detect-microsoft';
import { ROOT_ELEMENT, ROOT_CLASS } from '@/scripts/constants';
import disableBodyScroll from '@/scripts/utils/toggle-body-scroll';

export default function (isOpened, scrollableSelector = null) {
  if (isOpened) {
    ROOT_ELEMENT.classList.add(`${ROOT_CLASS}_has-modal`);
    disableBodyScroll(true, scrollableSelector);
  } else if (detectMicrosoft()) {
    $(ROOT_ELEMENT).one('transitionend', () => {
      ROOT_ELEMENT.classList.remove(`${ROOT_CLASS}_has-modal`);
      disableBodyScroll(false, scrollableSelector);
    });
  } else {
    ROOT_ELEMENT.addEventListener('transitionend', () => {
      ROOT_ELEMENT.classList.remove(`${ROOT_CLASS}_has-modal`);
      disableBodyScroll(false, scrollableSelector);
    }, { once: true });
  }
}
