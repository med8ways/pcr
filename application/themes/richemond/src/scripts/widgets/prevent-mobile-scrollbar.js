/**
 * Prevent resizing of elements with height equal to 100vh when mobile devices hide their
 * url toolbar after first scroll
 */

import createEvent from '../utils/create-event';

let w = window.innerWidth;
window.addEventListener('resize', () => {
    if (window.innerWidth !== w) {
        w = window.innerWidth;
        window.dispatchEvent(createEvent('resize.horizontal'));
    }
});

$.fn.vh100 = function () {
    const updateHeight = () => this.css('min-height', function() {
        return Math.max(window.innerHeight, this.scrollHeight);
    });
    window.addEventListener('resize.horizontal', updateHeight);
    updateHeight();
};