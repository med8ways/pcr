import Scrollbar from 'smooth-scrollbar';
import ScrollMagic from 'scrollmagic';
import anime from 'animejs';
import isMobile from './utils/detect-mobile';
import {duration, easing} from './animation-settings';

export function initScrollbar() {

    const timeline = document.getElementById('timeline'),
        isTimeline = !!timeline;

    let scrollbar,
        whiteThing,
        smoothScrollDisabled = isMobile || isTimeline;

    if (isMobile) {
        document.documentElement.classList.add('mobile');
    }

    if (isTimeline) {
        const scroller = document.querySelector('.scroller')
        if (scroller) {
            scroller.style.height = 'auto'
            scroller.style.overflow = 'hidden'
            document.body.style.overflowY = 'scroll'
            document.body.style.webkitOverflowScrolling = 'touch'
        }
    }

    // append white thing
    (() => {
        if (!document.querySelector('.section_news') &&
            !document.querySelector('.two-halves_bg-velvet + .breadcrumbs')) {
            return;
        }

        const blackThing = document.querySelector('.breadcrumbs') ||
            document.querySelector('.footer');
        whiteThing = document.createElement('div');
        whiteThing.className = 'white-thing';
        blackThing.parentElement.insertBefore(whiteThing, blackThing);
    })();

    // timeline
    if (isTimeline) {
        const timelineItems = Array.from(document.querySelectorAll('.timeline-item')),
            timelineNav = document.createElement('ul'),
            years = timelineItems.map(el => {
                const li = document.createElement('li');
                li.innerHTML = `<span>${el.querySelector('.timeline-item__year').textContent}</span>`;
                li.addEventListener('click', () => _scrollTo(el.offsetTop - 140, 1200));
                timelineNav.appendChild(li);
                return li;
            });
        timelineNav.className = 'timeline-nav';
        timeline.appendChild(timelineNav);
        const controller = new ScrollMagic.Controller()
        const timelineScene = new ScrollMagic.Scene({
            triggerElement: timeline,
            triggerHook: 'onLeave',
            duration: timeline.scrollHeight - timelineNav.scrollHeight
        })
            .setPin(timelineNav)
            .addTo(controller)

        // mascotte
        const mascotte = document.querySelector('.mascotte')
        const paths = Array.from(mascotte.querySelector('.paths').children)
        const container = $(mascotte).closest('.grid-container')[0]
        const mascotteScene = new ScrollMagic.Scene({
            triggerElement: mascotte,
            triggerHook: 1 - 60 / window.innerHeight,
            duration: timeline.scrollHeight - mascotte.offsetTop
        })
            .setPin(mascotte)
            .addTo(controller)


        const animation = [
            [
                'M130.8 107.5c1.1 3.1 18.6-4.8 20.3-6.5 4-4 16.4-9 17.4-12.1 4.2-13.1-11.5-9.9-16.9-8.1-3.9 1.3-6 1.9-9.4 7.4-1.1 1.8-2.5 4.6 1.5 10.5 2.5 3.6-13.1 6.6-12.9 8.8z',
                'M144.6,96.2c2.8,4.6,11.2,4.6,8,7.8c-0.8,0.8-1.7,0.6-5,0.8c-2.8,0.2-3.5,2.6-1.1,2.9 c13.6,2.3,14.9-6.9,15.8-10.2c0.9-3.2,2.6-7.6,3.5-9.9c1.4-3.8-6.4-7.5-13.8-5.9c-3.8,0.8-7.2,3.4-9,6.9c-0.8,1.5-1.2,3.1-0.7,4.4 C142.9,94.2,143.8,94.9,144.6,96.2z',
                'M173.5,98.8c5.8,2.1,9.7,10.8,11.9,9.6c2.2-1.4-2.1-6.5-5.5-12.5c-1.2-2.1-8.6-3.4-9.8-6.4 c-1.5-3.9-1.6-2.1-2.8-5c-1.5-3.4-11.3-5.9-16.1-2.9c-3.5,2.2-5.9,5.3-5,10.1c0.4,2,5.8,7.7,12.9,7.6   C164.7,99.3,170.7,97.8,173.5,98.8z'
            ],
            [
                'M75.5 92.1c-.2 1-5.4 7.8-1.3 9.9 3.7 1.9 10.1 2.2 11.1 4 .5.9.7 1.8.2 2.2-2.6 2.3-12.5-2.6-15.5-3.7-3.3-1.2-5.7-6.8-7.8-10.6-.9-1.6-4.7-7.5-3.4-8.8 3.2-3.2 12.8-2.8 16.6-.8 1.5.8 2.1 2.7 1.5 4.4-.7 1.1-1.2 2.5-1.4 3.4z',
                'M64.7,98.4c0.1,0.9-0.2,1.6-0.9,2.2c-1.3,1.1-2.6,1.4-3.9,1.7c-1.5,0.4-3,0.7-4.2,2.3c-0.6,0.8-0.7,1.4-0.4,2 c0.4,0.8,1.7,1.3,4,1.5c0.8,0.1,1.7,0.1,2.8,0.1c2,0,3.8-1.8,6-3.9c2-1.9,4.5-4.1,6.3-5.7c1.3-1.1,1.5-3,0.4-4.3 c-2.6-3.3-5.1-4.3-8.9-3c-1.5,0.6-2.3,2.2-1.9,3.8C64.3,96.2,64.7,97.5,64.7,98.4z',
                'M56.9,96.7c-5.4,2.2-14.5-0.9-15.7,0.8c-0.6,0.8-0.1,1.8,0.5,2.2c7.9,5.3,37.4,0.3,40.1-0.6   c1.7-0.6,0-4.1-1-5.5c-2.7-3.6-12.3-4.7-16.3-3.2c-1.6,0.6-2.5,2.4-2.1,4.1C62.7,95.6,61.1,95,56.9,96.7z'
            ],
            [
                'M106.1,92.6c20.4-1,27.7-10,30.1-14.7c0-0.1,0.1-0.2,0.1-0.2c-0.5,0-1.1,0-1.7,0.1c-1.8,0.1-3.7,0.2-5.5,0.3 c-7.7,0.4-18.2,0.9-24.4,0.4c-6.9-0.5-17-1.7-23.3-2.4c-0.6-0.1-2.9-0.4-3.2-0.5c0,0.1,0,0.2,0.1,0.3 C79.3,81.2,84.3,93.7,106.1,92.6z',
                'M106.1,92.6c20.4-1,27.7-10,30.1-14.7c0-0.1,0.1-0.2,0.1-0.2c-0.5,0-1.1,0-1.7,0.1c-1.8,0.1-3.7,0.2-5.5,0.3 c-7.7,0.4-18.2,0.9-24.4,0.4c-6.9-0.5-17-1.7-23.3-2.4c-0.6-0.1-2.9-0.4-3.2-0.5c0,0.1,0,0.2,0.1,0.3 C79.3,81.2,84.3,93.7,106.1,92.6z',
                'M106.1,92.6c20.4-1,27.7-10,30.1-14.7c0-0.1,0.1-0.2,0.1-0.2c-0.5,0-1.1,0-1.7,0.1c-1.8,0.1-3.7,0.2-5.5,0.3 c-7.7,0.4-18.2,0.9-24.4,0.4c-6.9-0.5-17-1.7-23.3-2.4c-0.6-0.1-2.9-0.4-3.2-0.5c0,0.1,0,0.2,0.1,0.3 C79.3,81.1,84.3,93.6,106.1,92.6z'
            ],
            [
                'M140.2,77.5c-0.9,0.1-2,0.1-2.9,0.2c-2.1,4.6-9.3,14.7-31.2,15.8c-2.3,0.1-4.4,0.1-6.3-0.1 c-18.1-1.4-21.9-13.5-22.6-18c-0.8-0.2-2.4-0.8-3.5-1.2l0,0c0,0.1,0,0.2,0,0.2c0.8,5.3,3.3,10.4,7.2,14.1c0.4,0.4,0.9,0.8,1.4,1.2 c10,8.2,26.8,7.4,38.8,3.7c9.7-2.8,16.3-8.1,19.9-15.8v-0.1l0,0C140.7,77.5,140.5,77.5,140.2,77.5z',
                'M140.2,77.5c-0.9,0.1-2,0.1-2.9,0.2c-2.1,4.6-9.3,14.7-31.2,15.8c-2.3,0.1-4.4,0.1-6.3-0.1 c-18.1-1.4-21.9-13.5-22.6-18c-0.8-0.2-2.4-0.8-3.5-1.2l0,0c0,0.1,0,0.2,0,0.2c0.8,5.3,3.3,10.4,7.2,14.1c0.4,0.4,0.9,0.8,1.4,1.2 c10,8.2,26.8,7.4,38.8,3.7c9.7-2.8,16.3-8.1,19.9-15.8v-0.1l0,0C140.7,77.5,140.5,77.5,140.2,77.5z',
                'M140.2,77.5c-0.9,0.1-2,0.1-2.9,0.2c-2.1,4.6-9.3,14.7-31.2,15.8c-2.3,0.1-4.4,0.1-6.3-0.1 C81.7,92,77.9,79.8,77.2,75.3c-0.8-0.2-2.4-0.8-3.5-1.2l0,0c0,0.1,0,0.2,0,0.2c0.8,5.3,3.3,10.4,7.2,14.1c0.4,0.4,0.9,0.8,1.4,1.2 c10,8.2,26.8,7.4,38.8,3.7c9.7-2.8,16.3-8.1,19.9-15.8v-0.1l0,0C140.7,77.4,140.5,77.5,140.2,77.5z'
            ],
            [
                'M106.1,92.6c20.4-1,27.7-10,30.1-14.7c0-0.1,0.1-0.2,0.1-0.2c-0.5,0-1.1,0-1.7,0.1c-1.8,0.1-3.7,0.2-5.5,0.3 c-7.7,0.4-18.2,0.9-24.4,0.4c-6.9-0.5-17-1.7-23.3-2.4c-0.6-0.1-2.9-0.4-3.2-0.5c0,0.1,0,0.2,0.1,0.3 C79.3,81.2,84.3,93.7,106.1,92.6z',
                'M106.1,92.6c20.4-1,27.7-10,30.1-14.7c0-0.1,0.1-0.2,0.1-0.2c-0.5,0-1.1,0-1.7,0.1c-1.8,0.1-3.7,0.2-5.5,0.3 c-7.7,0.4-18.2,0.9-24.4,0.4c-6.9-0.5-17-1.7-23.3-2.4c-0.6-0.1-2.9-0.4-3.2-0.5c0,0.1,0,0.2,0.1,0.3 C79.3,81.2,84.3,93.7,106.1,92.6z',
                'M106.1,92.6c20.4-1,27.7-10,30.1-14.7c0-0.1,0.1-0.2,0.1-0.2c-0.5,0-1.1,0-1.7,0.1c-1.8,0.1-3.7,0.2-5.5,0.3 c-7.7,0.4-18.2,0.9-24.4,0.4c-6.9-0.5-17-1.7-23.3-2.4c-0.6-0.1-2.9-0.4-3.2-0.5c0,0.1,0,0.2,0.1,0.3 C79.3,81.1,84.3,93.6,106.1,92.6z'
            ],
            [
                'M140.2,77.5c-0.9,0.1-2,0.1-2.9,0.2c-2.1,4.6-9.3,14.7-31.2,15.8c-2.3,0.1-4.4,0.1-6.3-0.1 c-18.1-1.4-21.9-13.5-22.6-18c-0.8-0.2-2.4-0.8-3.5-1.2l0,0c0,0.1,0,0.2,0,0.2c0.8,5.3,3.3,10.4,7.2,14.1c0.4,0.4,0.9,0.8,1.4,1.2 c10,8.2,26.8,7.4,38.8,3.7c9.7-2.8,16.3-8.1,19.9-15.8v-0.1l0,0C140.7,77.5,140.5,77.5,140.2,77.5z',
                'M140.2,77.5c-0.9,0.1-2,0.1-2.9,0.2c-2.1,4.6-9.3,14.7-31.2,15.8c-2.3,0.1-4.4,0.1-6.3-0.1 c-18.1-1.4-21.9-13.5-22.6-18c-0.8-0.2-2.4-0.8-3.5-1.2l0,0c0,0.1,0,0.2,0,0.2c0.8,5.3,3.3,10.4,7.2,14.1c0.4,0.4,0.9,0.8,1.4,1.2 c10,8.2,26.8,7.4,38.8,3.7c9.7-2.8,16.3-8.1,19.9-15.8v-0.1l0,0C140.7,77.5,140.5,77.5,140.2,77.5z',
                'M140.2,77.5c-0.9,0.1-2,0.1-2.9,0.2c-2.1,4.6-9.3,14.7-31.2,15.8c-2.3,0.1-4.4,0.1-6.3-0.1 C81.7,92,77.9,79.8,77.2,75.3c-0.8-0.2-2.4-0.8-3.5-1.2l0,0c0,0.1,0,0.2,0,0.2c0.8,5.3,3.3,10.4,7.2,14.1c0.4,0.4,0.9,0.8,1.4,1.2 c10,8.2,26.8,7.4,38.8,3.7c9.7-2.8,16.3-8.1,19.9-15.8v-0.1l0,0C140.7,77.4,140.5,77.5,140.2,77.5z'
            ],
            [
                'M214 76.5c-.4-.7-24.3 10.9-37.1 7.1-4.1-1.2-5.5-2.9-6.8-4.1 0 0-.9-.8-1-.9-7.1-3.8-10.9 2.3-4.9 7.5 1.4 1.2 3.3 1.7 5.1 1.3H169.9c.8-.1 1.7.2 2.9.5 3.6.9 9.7 2.5 21.3-1.6 14.2-4.9 19.6-8.4 19.9-9.5V76.5z',
                'M212.6,67.5c-0.5-0.6-21.8,15.3-35,14c-4.3-0.4-6-1.8-7.5-2.8c0,0-1.1-0.6-1.1-0.7c-7.7-2.4-10.3,4.3-3.4,8.3 c1.6,0.9,3.5,1.1,5.2,0.4c0.1-0.1,0.2-0.1,0.2-0.1l0.4-0.1c0.8-0.2,1.7-0.1,3-0.1c3.8,0.2,10,0.6,20.7-5.6 c13-7.5,17.7-11.9,17.7-13.1v-0.2L212.6,67.5z',
                'M204.4,54c-0.7-0.4-16,21.3-29,24.1c-4.2,0.9-6.2,0.1-8-0.3c-0.1,0-1.2-0.3-1.3-0.3c-8.1,0.1-8.4,7.2-0.7,8.9 c1.8,0.4,3.7-0.1,5.1-1.3c0.1-0.1,0.2-0.1,0.2-0.2l0.3-0.2c0.7-0.4,1.6-0.7,2.8-1c3.6-0.9,9.7-2.5,17.9-11.7 c10-11.2,13.2-16.8,12.8-17.9l-0.1-0.2V54z'
            ],
            [
                'M170.9,80.1c-0.5-1-1.4-1.8-2.4-2.3c-1.2-0.6-2.6-1.1-4.9-1.3c-6.1-0.5-18.7-0.2-21.2-0.1 c-1.8,0.1-10.3,0.5-13.4,0.7c-7.6,0.4-18.1,0.9-24.3,0.4c-7.5-0.6-18.9-1.9-25-2.6c-2-0.2-5-1.4-6.5-2c-1.6-0.7-3.1-1.7-4.4-2.8 c-5.2-4.8-8.7-8.3-9.9-9.8c-2.3-3-4.6-5-8-5.3c-3.1-0.2-9.9,3.9-10.1,4l-5.4,2.7c-0.7,0.3-1.2,1-1.4,1.7c-0.6,2.1-1.3,2.8-1.7,2.9 h-0.2c-0.1,0-7.9,3.8-12.1,6c-0.7,0.4-1.5,0.5-2.3,0.7c-0.5,0.1-1,0.2-1.6,0.4c-0.6,0.2-1.3,0.5-1.5,1.5c-0.3,1.4,0.8,2.1,1.2,2.3 c0.1,0.1,0.2,0.4,0.3,0.6c0.6,1.4,1.6,4,7,4c2.5,0,6.4-0.7,10.6-1.4c3.7-0.6,7.5-1.3,10.7-1.5c3.2-0.3,7.4,1.6,8.5,4.9 c0,0.1,0.1,0.3,0.1,0.4c1.5,4.2,4.6,7.6,8.5,9.6c1,0.5,2.1,1.2,2.7,1.8c1.8,1.8,4.2,2.7,6.8,2.6l4.1-0.3c0.8-0.1,1.6,0,2.4,0.2 c1.2,0.3,2.9,0.7,2.9,0.7c18.3,4.2,45.9-1.1,55.9-4.7c2.1-0.8,3.7-1.2,4.9-1.3l1.4-0.1c0.4,0,0.8,0,1.2,0c1.8,0,3.5,0.7,5,1.6 c3.2,2,10.8,1.5,13.4-2.8c1.5-2.5,3.4-2.6,6-3.9l0,0c2.7-1.4,3.9-4.7,2.5-7.4C171,80.2,171,80.2,170.9,80.1z M81.3,76 c6.3,0.8,16.4,1.9,23.3,2.4c6.2,0.5,16.8-0.1,24.4-0.4c1.8-0.1,3.7-0.2,5.5-0.3c0.6,0,1.2,0,1.7-0.1c0,0.1-0.1,0.2-0.1,0.2 c-2.4,4.7-9.7,13.6-30.1,14.7c-21.9,1.1-26.8-11.4-27.9-16.7c0-0.1,0-0.2-0.1-0.3C78.4,75.6,80.7,76,81.3,76z M140.9,77.6 c-3.6,7.7-10.2,13-19.9,15.8c-11.9,3.8-28.8,4.5-38.8-3.7c-0.5-0.4-0.9-0.8-1.4-1.2c-3.9-3.7-6.4-8.8-7.2-14.1c0-0.1,0-0.2,0-0.2 l0,0c1.1,0.4,2.7,1,3.5,1.2c0.8,4.5,4.5,16.7,22.7,18.1c1.9,0.2,4,0.2,6.3,0.1c21.8-1.1,29-11.2,31.2-15.8c0.9-0.1,2-0.1,2.9-0.2 C140.5,77.5,140.7,77.5,140.9,77.6C141,77.5,141,77.5,140.9,77.6C140.9,77.5,140.9,77.5,140.9,77.6z',
                'M170.9,80.1c-0.5-1-1.4-1.8-2.4-2.3c-1.2-0.6-2.6-1.1-4.9-1.3c-6.1-0.5-18.7-0.2-21.2-0.1 c-1.8,0.1-10.3,0.5-13.4,0.7c-7.6,0.4-18.1,0.9-24.3,0.4c-7.5-0.6-18.9-1.9-25-2.6c-2-0.2-5-1.4-6.5-2c-1.6-0.7-3.1-1.7-4.4-2.8 c-5.2-4.8-8.7-8.3-9.9-9.8c-2.3-3-4.6-5-8-5.3c-3.1-0.2-9.9,3.9-10.1,4l-5.4,2.7c-0.7,0.3-1.2,1-1.4,1.7c-0.6,2.1-1.3,2.8-1.7,2.9 h-0.2c-0.1,0-7.9,3.8-12.1,6c-0.7,0.4-1.5,0.5-2.3,0.7c-0.5,0.1-1,0.2-1.6,0.4c-0.6,0.2-1.3,0.5-1.5,1.5c-0.3,1.4,0.8,2.1,1.2,2.3 c0.1,0.1,0.2,0.4,0.3,0.6c0.6,1.4,1.6,4,7,4c2.5,0,6.4-0.7,10.6-1.4c3.7-0.6,7.5-1.3,10.7-1.5c3.2-0.3,7.4,1.6,8.5,4.9 c0,0.1,0.1,0.3,0.1,0.4c1.5,4.2,4.6,7.6,8.5,9.6c1,0.5,2.1,1.2,2.7,1.8c1.8,1.8,4.2,2.7,6.8,2.6l4.1-0.3c0.8-0.1,1.6,0,2.4,0.2 c1.2,0.3,2.9,0.7,2.9,0.7c18.3,4.2,45.9-1.1,55.9-4.7c2.1-0.8,3.7-1.2,4.9-1.3l1.4-0.1c0.4,0,0.8,0,1.2,0c1.8,0,3.5,0.7,5,1.6 c3.2,2,10.8,1.5,13.4-2.8c1.5-2.5,3.4-2.6,6-3.9l0,0c2.7-1.4,3.9-4.7,2.5-7.4C171,80.2,171,80.2,170.9,80.1z M81.3,76 c6.3,0.8,16.4,1.9,23.3,2.4c6.2,0.5,16.8-0.1,24.4-0.4c1.8-0.1,3.7-0.2,5.5-0.3c0.6,0,1.2,0,1.7-0.1c0,0.1-0.1,0.2-0.1,0.2 c-2.4,4.7-9.7,13.6-30.1,14.7c-21.9,1.1-26.8-11.4-27.9-16.7c0-0.1,0-0.2-0.1-0.3C78.4,75.6,80.7,76,81.3,76z M140.9,77.6 c-3.6,7.7-10.2,13-19.9,15.8c-11.9,3.8-28.8,4.5-38.8-3.7c-0.5-0.4-0.9-0.8-1.4-1.2c-3.9-3.7-6.4-8.8-7.2-14.1c0-0.1,0-0.2,0-0.2 l0,0c1.1,0.4,2.7,1,3.5,1.2c0.8,4.5,4.5,16.7,22.7,18.1c1.9,0.2,4,0.2,6.3,0.1c21.8-1.1,29-11.2,31.2-15.8c0.9-0.1,2-0.1,2.9-0.2 C140.5,77.5,140.7,77.5,140.9,77.6C141,77.5,141,77.5,140.9,77.6C140.9,77.5,140.9,77.5,140.9,77.6z',
                'M170.9,80.1c-0.5-1-1.4-1.8-2.4-2.3c-1.2-0.6-2.6-1.1-4.9-1.3c-6.1-0.5-18.7-0.2-21.2-0.1 c-1.8,0.1-10.3,0.5-13.4,0.7c-7.6,0.4-18.1,0.9-24.3,0.4c-7.5-0.6-18.9-1.9-25-2.6c-2-0.2-5-1.4-6.5-2c-1.6-0.7-3.1-1.7-4.4-2.8 c-5.2-4.8-8.7-8.3-9.9-9.8c-2.3-3-4.6-5-8-5.3c-3.1-0.2-9.9,3.9-10.1,4l-5.4,2.7c-0.7,0.3-1.2,1-1.4,1.7c-0.6,2.1-1.3,2.8-1.7,2.9 h-0.2c-0.1,0-7.9,3.8-12.1,6c-0.7,0.4-1.5,0.5-2.3,0.7c-0.5,0.1-1,0.2-1.6,0.4c-0.6,0.2-1.3,0.5-1.5,1.5c-0.3,1.4,0.8,2.1,1.2,2.3 c0.1,0.1,0.2,0.4,0.3,0.6c0.6,1.4,1.6,4,7,4c2.5,0,6.4-0.7,10.6-1.4c3.7-0.6,7.5-1.3,10.7-1.5c3.2-0.3,7.4,1.6,8.5,4.9 c0,0.1,0.1,0.3,0.1,0.4c1.5,4.2,4.6,7.6,8.5,9.6c1,0.5,2.1,1.2,2.7,1.8c1.8,1.8,4.2,2.7,6.8,2.6l4.1-0.3c0.8-0.1,1.6,0,2.4,0.2 c1.2,0.3,2.9,0.7,2.9,0.7c18.3,4.2,45.9-1.1,55.9-4.7c2.1-0.8,3.7-1.2,4.9-1.3l1.4-0.1c0.4,0,0.8,0,1.2,0c1.8,0,3.5,0.7,5,1.6 c3.2,2,10.8,1.5,13.4-2.8c1.5-2.5,3.4-2.6,6-3.9l0,0c2.7-1.4,3.9-4.7,2.5-7.4C171,80.1,171,80.1,170.9,80.1z M81.3,76 c6.3,0.8,16.4,1.9,23.3,2.4c6.2,0.5,16.8-0.1,24.4-0.4c1.8-0.1,3.7-0.2,5.5-0.3c0.6,0,1.2,0,1.7-0.1c0,0.1-0.1,0.2-0.1,0.2 c-2.4,4.7-9.7,13.6-30.1,14.7c-21.9,1.1-26.8-11.4-27.9-16.7c0-0.1,0-0.2-0.1-0.3C78.4,75.6,80.7,75.9,81.3,76z M140.9,77.5 c-3.6,7.7-10.2,13-19.9,15.8c-11.9,3.8-28.8,4.5-38.8-3.7c-0.5-0.4-0.9-0.8-1.4-1.2c-3.9-3.7-6.4-8.8-7.2-14.1c0-0.1,0-0.2,0-0.2 l0,0c1.1,0.4,2.7,1,3.5,1.2c0.8,4.5,4.5,16.7,22.7,18.1c1.9,0.2,4,0.2,6.3,0.1c21.8-1.1,29-11.2,31.2-15.8c0.9-0.1,2-0.1,2.9-0.2 C140.5,77.5,140.7,77.4,140.9,77.5C141,77.4,141,77.4,140.9,77.5L140.9,77.5z'
            ]
        ]
        let count = 0, skipCount = 0, mascotteProgress = 0
        const skip = 6
        timelineScene.on('progress', e => {
            paths.forEach((path, i) => {
                path.setAttribute('d', animation[i][count])
            })
            skipCount++
            if (skipCount % skip === 0) {
                count = (count + 1) % animation[0].length
            }
            mascotteProgress = e.progress
            updateMascotteProgress()
        })
        window.addEventListener('resize', () => {
            timelineScene.duration(timeline.scrollHeight - timelineNav.scrollHeight)
            timelineScene.triggerHook('onLeave')
            mascotteScene.duration(timeline.scrollHeight - mascotte.offsetTop)
            mascotteScene.triggerHook(1 - 60 / window.innerHeight)
            updateMascotteProgress()
        })
        function updateMascotteProgress() {
            mascotte.style.transform = 'translateX(' + ((window.innerWidth + mascotte.clientWidth) * mascotteProgress - container.offsetLeft - mascotte.clientWidth)+ 'px)';
        }
        let activeYear = 0
        timelineItems.forEach((el, i) => {
            const year = el.querySelector('.timeline-item__year')
            const content = Array.from(el.querySelectorAll('.user-editable-content > *'))
            if (!year) return
            new ScrollMagic.Scene({
                triggerElement: year
            }).on('start', () => {
                years[activeYear].classList.remove('active')
                activeYear = i
                years[activeYear].classList.add('active')
            })
                .addTo(controller)
            content.forEach(el => {
                el.style.opacity = 0
                el.style.transform = 'translateY(30px)'
                const scene = new ScrollMagic.Scene({
                    triggerElement: el,
                    triggerHook: .95,
                    reverse: false
                }).addTo(controller)
                scene.on('start', e => {
                    anime({
                        targets: el,
                        opacity: 1,
                        translateY: 0,
                        duration: 500,
                        easing: 'easeOutQuad'
                    })
                })
            })
        })
    }

    Array.prototype.forEach.call(document.querySelectorAll('.cover, .breadcrumbs, .footer'), el => el.style.zIndex = 2);

    const scrollbarElement = document.querySelector('.scroller'),
        scrollToTopElement = document.querySelector('.scroll-to-top'),
        parallaxGroups = {
            .5: Array.from(document.querySelectorAll('.cover__overlay')),
            .25: Array.from(document.querySelectorAll('.cover__effect')),
            '-.05': Array.from(document.querySelectorAll('.two-halves__image')),
            '-.15': Array.from(document.querySelectorAll('.two-halves .emblem i')),
            '-.11': Array.from(document.querySelectorAll('.top-image img')),
            .111: Array.from(document.querySelectorAll('.top-image + .plate .plate__white')),
            .112: Array.from(document.querySelectorAll('.plate.collapsed'))
        };
    if (whiteThing) {
        parallaxGroups[.151] = [whiteThing];
    }
    let needsScrollTop = false;
    if (smoothScrollDisabled) {
        scrollbarElement.addEventListener('scroll', () => _onScroll(scrollbarElement.scrollTop));
    } else {
        scrollbar = Scrollbar.init(scrollbarElement, {
            damping: .07
        });
        scrollbar.addListener(({offset}) => _onScroll(offset.y));
    }
    Array.from(document.querySelectorAll('.tabs-toggles')).forEach(toggles => {
        Array.from(toggles.querySelectorAll('li')).forEach(li => {
            li.addEventListener('click', () => _scrollTo(toggles.offsetTop + toggles.clientHeight - 170, 1000));
        });
    });
    Array.from(document.querySelectorAll('.scroll__button')).forEach(el => {
        el.addEventListener('click', () => _scrollTo(el.offsetTop, 1000));
    });
    if (scrollToTopElement) {
        document.body.appendChild(scrollToTopElement);
        scrollToTopElement.addEventListener('click', () => _scrollTo(0, 1500));
    }
    if (!smoothScrollDisabled) {
        _updateParallax();
        window.addEventListener('resize', () => {
            _updateParallax();
        });
    }

    // scroll to reservation
    (() => {

        const scrollToReservation = Array.from(document.querySelectorAll('.scroll-to-reservation')),
            contactForm = document.querySelector('.plate_contact-form');

        if (!contactForm) return;

        const firstInput = contactForm.querySelector('.input');

        scrollToReservation.forEach(el => el.addEventListener('click', e => {
            e.preventDefault();
            _scrollTo(contactForm.offsetTop, 1000);
            if (firstInput) {
                setTimeout(() => $(firstInput).trigger('focusin'), 1000);
            }
        }));
    })();

    // scroll by anchor links
    (() => {
        const a = Array.from(document.querySelectorAll('a')).filter(a => {
            const href = a.getAttribute('href');
            return href && href[0] === '#';
        }).forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                _scrollToElementById(a.getAttribute('href').slice(1));
            });
        });
        if (window.location.hash) {
            _scrollToElementById(window.location.hash.slice(1));
        }
        function _scrollToElementById(id) {
            const el = document.getElementById(id);
            if (!el) return;
            _scrollTo(el.offsetTop - 120, 1500);
        }
    })();

    function _onScroll(scrollPosition) {
        if (+needsScrollTop + +(scrollPosition > .5 * window.innerHeight) === 1) {
            needsScrollTop = !needsScrollTop;
            scrollToTopElement.classList.toggle('visible', needsScrollTop);
        }
        if (!smoothScrollDisabled) {
            _updateParallax();
        }
        window.dispatchEvent(new CustomEvent('smooth-scroll', {
          detail: scrollPosition,
        }));
    }

    function _scrollTo(scrollPosition, duration) {
        if (smoothScrollDisabled) {
            anime({
                targets: scrollbarElement,
                scrollTop: scrollPosition,
                duration: duration,
                easing: easing
            });
        } else {
            scrollbar.scrollTo(0, scrollPosition, duration);
        }
    }

    function _updateParallax() {
        for (let speed in parallaxGroups) {
            parallaxGroups[speed].forEach(el => {
                el.style.transform = `translateY(${Number(speed) * (
                    el.parentElement.getBoundingClientRect().top +
                    .5 * (el.parentElement.clientHeight - scrollbarElement.clientHeight)
                )}px) translateZ(0)`
            })
        }
    }
}

export function initPreloader() {
    const page = document.querySelector('.ccm-page');
    page.style.opacity = 0;
    anime({
        targets: page,
        opacity: 1,
        delay: .5 * duration,
        duration: .33 * duration,
        easing: easing
    });
    Array.from(document.querySelectorAll('a')).filter(a => {
        return a.getAttribute('href') &&
            !a.getAttribute('href').match(/^(#|tel:|mailto:|javascript:)/) &&
            a.getAttribute('target') !== '_blank';
    }).forEach(el => {
        el.addEventListener('click', e => {
            e.preventDefault();
            anime({
                targets: page,
                opacity: 0,
                duration: .33 * duration,
                easing: easing,
                complete: () => {
                    window.location = el.getAttribute('href');
                }
            });
        })
    });
}