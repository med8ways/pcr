document.addEventListener('DOMContentLoaded', () => {

    let inputs = $('.input-group input, .input-group textarea');

    // classes scaled and invalid are appended to parent block '.input-block'

    inputs.each((index) => {

        inputs.eq(index).focusin(() => {
            inputs.eq(index).parent().addClass('scaled');
        }).focusout(() => {
            if (inputs.eq(index).val().trim() === '') {
                inputs.eq(index).parent().removeClass('scaled');
            }
        });

    });

    // clear form function

    // function clearForm() {
    //     inputs.each(function (index) {
    //         if (inputs.eq(index).val() !== '') {
    //             inputs.eq(index).val('');
    //             inputs.eq(index).parent().removeClass('scaled');
    //         }
    //     });
    // }

    // show message

    // function displaySubmitMessage($messageBlock, $contactBlock) {
    //     $contactBlock.animate({'opacity': '0'}, 500);
    //     $messageBlock.delay(300).animate({'opacity': '1'}, 500);
    //     setTimeout(clearForm, 1000);
    //     setTimeout(() => {
    //         $contactBlock.animate({'opacity': '1'}, 500);
    //         $messageBlock.animate({'opacity': '0'}, 500);
    //     }, 2500);
    // }

    // progress button start

    // function startProgress(btn, time) {
    //     btn.addClass('hovered disabled');
    //     btn.find('.progress-line').animate({
    //         'width': '100%'
    //     }, time);
    //     setTimeout(() => {
    //         btn.removeClass('hovered disabled');
    //     }, time);
    //     setTimeout(() => {
    //         btn.find('.progress-line').removeAttr('style');
    //     }, (time + 100));
    // }

    // progress button end

    // function endProgress(btn) {
    //     btn.removeClass('hovered disabled');
    //     setTimeout(() => {
    //         btn.find('.progress-line').removeAttr('style');
    //     }, 100);
    // }
    //
    // $('.contact-form').submit((e) => {
    //
    //     e.preventDefault();
    //
    //     let result = true;
    //
    //     // validation code here
    //
    //     if (result) {
    //
    //         startProgress($('.btn_progress'), 2500);
    //         displaySubmitMessage($('.contact-box__message'), $('.contact-box__wrap'));
    //
    //     }
    //
    // });

});