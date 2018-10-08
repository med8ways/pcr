document.addEventListener('DOMContentLoaded', () => {

    let userAgent = window.navigator.userAgent,
        ieReg = /msie|Trident.*rv[ :]*11\./gi,
        ie = ieReg.test(userAgent);

    if (ie) {
        $(".image-box").each(function () {
            let $container = $(this),
                imgUrl = $container.find("img").prop("src");
            if (imgUrl) {
                $container.css("backgroundImage", 'url(' + imgUrl + ')').addClass("custom-object-fit");
            }
        });
    }

});