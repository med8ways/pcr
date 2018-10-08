import detectMobile from '@/scripts/utils/detect-mobile'

document.addEventListener('DOMContentLoaded', () => {

    const customSelect = $('.js-custom-select'),
        selectItem = customSelect.find('select');

    function generateCustomSelect() {

        if (selectItem.length) {

            customSelect.each(function (index) {

                const list = customSelect.eq(index).find('option:not(:first-child)');

                if (selectItem.eq(index).attr('data-error') !== undefined) {
                    customSelect.eq(index).prepend('<input type="text" class="input validate_required" data-error="' + selectItem.eq(index).attr('data-error') + '" readonly placeholder="' + customSelect.eq(index).children('select').children('option:first-child').text() + '">');
                    customSelect.eq(index).append('<input type="hidden">');
                } else {
                    customSelect.eq(index).prepend('<input type="text" class="input" readonly placeholder="' + customSelect.eq(index).children('select').children('option:first-child').text() + '">');
                    customSelect.eq(index).append('<input type="hidden">');
                }
                customSelect.eq(index).append('<div class="dropdown-input__list"></div>');
                customSelect.eq(index).find('.dropdown-input__list').append('<ul></ul>');

                list.each(function (i) {
                    if (list.eq(i).attr('selected') !== undefined) {
                        list.eq(i).closest(customSelect).children('input').val(list.eq(i).text());
                        customSelect.eq(index).children('.dropdown-input__list').children('ul').append('<li class="active">' + list.eq(i).text() + '</li>');
                        if (list.eq(i).closest(customSelect).hasClass('input-box')) {
                            list.eq(i).closest(customSelect).children('input').addClass('scaled');
                        }
                    } else {
                        customSelect.eq(index).children('.dropdown-input__list').children('ul').append('<li data-value="' + list.eq(i).attr('value') + '">' + list.eq(i).text() + '</li>');
                    }
                })
            });

        }
    }

    if (!detectMobile()) {

        generateCustomSelect();
        selectItem.remove();

        function closeAll() {
            customSelect.each(function (index) {
                if (customSelect.eq(index).hasClass('active')) {
                    customSelect.eq(index).removeClass('active');
                }
            })
        }

        function clearActive(arr) {
            arr.each(function (index) {
                arr.eq(index).removeClass('active');
            });
        }

        //click on select

        customSelect.click(function () {

            const index = customSelect.index(this);

            if (customSelect.eq(index).hasClass('active')) {

                closeAll();

            } else {

                closeAll();
                customSelect.eq(index).addClass('active');

            }

        });

        $(document).on('click touchstart', function (e) {
            if (!$(e.target).closest(customSelect).length) {
                closeAll();
            }
        });


        // click on select item

        customSelect.on('click', 'li', function () {
            const closestCustomSelect = $(this).closest(customSelect);

            if (closestCustomSelect.hasClass('active')) {
                clearActive($(this).siblings('li'));

                $(this).addClass('active');

                closestCustomSelect.children('[type="text"]')
                    .val($(this).text())
                    .trigger('focusout');

                closestCustomSelect.children('[type="hidden"]')
                    .val($(this).attr('data-value'))
                    .trigger('focusout');
            }

            if (closestCustomSelect.hasClass('active') && !closestCustomSelect.hasClass('scaled')) {

                closestCustomSelect.addClass('scaled');

            }
        });
    } else {

        if (selectItem.length) {

            customSelect.each(function (index) {

                const list = customSelect.eq(index).children('select').children('option:not(:first-child)');

                list.each(function (i) {

                    if (list.eq(i).attr('selected') !== undefined) {

                        list.closest('.input-block').find('.input').trigger('focusout');

                        list.eq(i).closest(customSelect).children('select').addClass('scaled');

                        return false;
                    }

                });

                return false;

            });

        }
    }

});