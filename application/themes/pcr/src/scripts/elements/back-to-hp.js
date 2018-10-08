import {ROOT_ELEMENT} from '@/scripts/constants';

document.addEventListener('DOMContentLoaded', function () {
    ROOT_ELEMENT.addEventListener('preloaderEnd', () => {
        if ($('.js-error-page').length) {
            setTimeout(function() {
                window.location = '/'; // insert current language from PHP here, for example '/fr'
            }, 3000);
        }
    });
});