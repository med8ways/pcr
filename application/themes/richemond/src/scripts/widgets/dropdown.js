$.fn.dropdown = function (config = {}) {
    const $dropdowns = this;
    $(document).click(e => $dropdowns
            .not($(e.target).closest($dropdowns))
            .trigger('dropdownToggle', [false])
    );
    $dropdowns.each((i, el) => {
        if (el.dropdownInitialized) return;
        el.dropdownInitialized = true;
        const $self = $(el)
            , finalConfig = Object.assign({}, config, $self.data())
            , {
                activeItemEnabled = false,
                topEnabled = false,
                items = "",
                topElement,
                dropdownElement,
                openEvent = 'click',
                closeEvent = 'click'
            } = finalConfig
            , top = topElement || el.querySelector('.dropdown__top') || $('<div >', {class: "dropdown__top"}).prependTo(el)[0]
            , title = top.querySelector('.dropdown__title') || $('<div >', {class: "dropdown__title"}).prependTo(top)[0]
            , $title = $(title)
            , arrow = top.querySelector('.dropdown__arrow') || $('<div >', {class: "dropdown__arrow icon-dropdown-arrow"}).appendTo(top)[0]
            , dropdown = dropdownElement || el.querySelector('.dropdown__dropdown') || $('<div >', {class: "dropdown__dropdown"}).appendTo(el)[0]
        ;
        let opened,
          $activeItem = $(),
          { itemsArray = [], activeIndex = null } = finalConfig,
          $items
        ;
        dropdown.style.position = 'absolute';
        dropdown.style.zIndex = 2;
        if (openEvent === closeEvent) {
            top.addEventListener(openEvent, () => $self.trigger('dropdownToggle', [!opened]));
        } else {
            if (openEvent) {
                top.addEventListener(openEvent, () => {
                    $self.trigger('dropdownToggle', [true]);
                });
            }
            if (closeEvent) {
                top.addEventListener(closeEvent, () => {
                    $self.trigger('dropdownToggle', [false]);
                });
            }
        }
        $self.on('dropdownToggle', (e, newOpened) => update(!!newOpened === newOpened ? newOpened : !opened));

        function setItemsArray(newItemsArray) {
          activeIndex = null;
          itemsArray = newItemsArray;
          dropdown.innerHTML = '';
          $items = $(`<ul>${itemsArray.map(item => `<li>${item}</li>`).join('')}</ul>`).appendTo(dropdown).find('li');
          updateHeight();
          $items.click(function () {
            if (activeItemEnabled) {
              $activeItem.removeClass('active');
              $activeItem = $(this).addClass('active');
              $self.trigger('dropdownChange', [$activeItem.text()]);
            }
            $self.trigger('dropdownToggle', [false]);
          });
          if (activeItemEnabled || activeIndex != null) {
            $activeItem = $items.filter('.active');
            if (!$activeItem.length && activeIndex != null) {
              $activeItem = $items.eq(activeIndex).addClass('active');
            }
          }
        }

        if (items) {
            itemsArray = JSON.parse(items.replace(/'/g, '"'));
        }

        if (itemsArray) {
          setItemsArray(itemsArray);
        }

        $self.on('setItemsArray', (e, array) => {
          setItemsArray(array);
        });

        $(dropdown).children('ul').on('mousewheel DOMMouseScroll', function(e) {
            if (this.clientHeight < this.scrollHeight) {
                e.stopPropagation()
            }
        });
        update(false);

        function updateHeight() {
          dropdown.style.height = '';
          dropdown.style.height = `${+opened * dropdown.scrollHeight}px`;
        }

        function update(isOpened) {
            if (opened === isOpened) return;
            opened = isOpened;
            updateHeight();
            arrow.style.transform = opened ? 'scaleY(-1)' : 'scaleY(1)';
            if (!opened && topEnabled) {
                $title.html($activeItem.text());
            }
            $self.toggleClass('dropdown_open', opened);
        }
    });
};
