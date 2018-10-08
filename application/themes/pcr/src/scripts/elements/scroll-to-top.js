document.addEventListener('DOMContentLoaded', () => {

    const scrollToTop = $('.scroll-to-top');

    scrollToTop.click(() => {

        $('html, body').animate({
            scrollTop: 0
        }, 500);

    });



});