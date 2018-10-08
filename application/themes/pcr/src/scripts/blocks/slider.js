import 'owl.carousel';
import editMode from '@/scripts/utils/detect-edit-mode';

document.addEventListener('DOMContentLoaded', () => {

    $('.js-slider').owlCarousel({
        items: 3,
        autoWidth: true,
        slideTransition: 'ease',
        nav: true,
        navText: [$('.js-slider-left'), $('.js-slider-right')],
        smartSpeed: 1000

    });

    if (editMode()) {
        $('.js-slider').owlCarousel('destroy');
    }
});