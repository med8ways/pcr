import isMobile from '@/scripts/utils/detect-mobile';

document.addEventListener('DOMContentLoaded', () => {

    (() => {

        let scroll = window.requestAnimationFrame,
            $element = $('.js-parallax-element'),
            $box = $('.js-parallax-box');
        
        function getHeadPosition(el) {

            return Math.round(el.offset().top - $(window).height());

        }

        if (!isMobile()) {

            function parallax() {

                let st = $(window).scrollTop(),
                    start,
                    end;

                if ($element.length) {

                    $element.each((i) => {

                        start = getHeadPosition($element.eq(i));
                        end = $element.eq(i).offset().top + $element.eq(i).parent().height();
                        if (st >= start && st <= end) {
                            $element.eq(i).css('transform', 'translate(0,' + ((st - start) * 0.12) + 'px');
                        } else if (st < start) {
                            $element.eq(i).removeAttr('style');
                        }

                    })

                }

                if ($box.length) {

                    start = getHeadPosition($box);
                    end = $box.offset().top + $box.parent().height();
                    if (st >= start && st <= end) {
                        $box.css('transform', 'translate(0,' + ((st - start) * 0.05) + 'px');
                    } else if (st < start) {
                        $box.removeAttr('style');
                    }

                }

                scroll(parallax);

            }

            parallax();

        }

    })();

});