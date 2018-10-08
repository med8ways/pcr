/**
 * widget that dynamically resizes images to make them cover parent elements
  */
$.fn.imageLayout = function (options = {}) {
    const {mode = "cover"} = options;
    return this.each(function () {
        const self = this
            , $self = $(this)
            , $images = $self.children('img, video')
        ;
        if (!$images.length) return;
        $self.css({
            display: 'flex',
            'justify-content': 'center',
            'align-items': 'center',
            overflow: 'hidden'
        });
        $images.css('flex', '1 0 auto').each(function()  {
            const image = this
                , $image = $(image)
            ;
            setTimeout(update, 200);
            image.onload = update;
            $(window).resize(update);
            $(self).on('imageLayoutUpdate', update);
            function update() {
                const imageAR = (image.width || image.videoWidth) / (image.height || image.videoHeight)
                    , containerAR = self.clientWidth / self.clientHeight
                ;
                let propHorizontal
                    , propVertical
                    , resetValue
                    , boolCondition = imageAR > containerAR
                ;
                switch (mode) {
                    case "shrink":
                    case "shrinkContain":
                        propHorizontal = "max-width";
                        propVertical = "max-height";
                        resetValue = "none";
                        break;
                    default:
                        propHorizontal = "width";
                        propVertical = "height";
                        resetValue = "auto";
                }
                if (mode === "contain" || mode === "shrinkContain") {
                    boolCondition = !boolCondition;
                }
                $image.css({
                        [propHorizontal]: resetValue,
                        [propVertical]: resetValue
                    })
                    .css(boolCondition ? propVertical : propHorizontal, '100%');
            }
        })
    })
}