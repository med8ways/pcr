import './dropdown';
import '@fengyuanchen/datepicker';
import detectEditMode from '../utils/detect-edit-mode';
import isMobile from '../utils/detect-mobile';
import { isValidNumber } from 'libphonenumber-js'
import { callingCountries } from 'country-data';

const codes = callingCountries.all.map(({ countryCallingCodes }) => countryCallingCodes)
  .flatten()
  .map(el => el.split(' ').join(''));

const VALIDATION_TYPES = {
        required: 0,
        email: 1,
        phone: 2
    }
    , dictionary = window.config && window.config.dictionary
    , CAPTCHA_API = "https://www.google.com/recaptcha/api.js"
;

function extractValidationTypes(string) {
    const matches = string.match(/_validate-(\S+)/g) || [];
    return matches.map(string => string.substr(10))
        .filter(string => string in VALIDATION_TYPES);
}

function validate(string, type, options = {}) {
    const { phoneCode } = options;
    switch (type) {
        case VALIDATION_TYPES.required:
            return !!string;
        case VALIDATION_TYPES.email:
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(string);
        case VALIDATION_TYPES.phone:
            return isValidNumber(phoneCode + string);
    }
}

$.fn.whitesquareInputBlock = function (config = {}) {
    return this.each((i, el) => {
        if (!el.inputBlock) el.inputBlock = {};
        const $self = $(el)
            , $label = $self.find('.label')
            , $error = $self.find('.input-block__error')
            , state = el.inputBlock
            , validationTypes = extractValidationTypes($self.attr("class"))
            , {
                liveValidation = false,
                dropdownItems = "",
                dropdownItemsArray = dropdownItems ? JSON.parse(dropdownItems.replace(/'/g, '"')) : [],
                datepickerLanguage = 'en-GB',
                type,
            } = Object.assign({}, config, $self.data())
            , isAutocomplete = type === 'autocomplete'
            , isPhone = validationTypes.includes('phone')
        ;
        let wasFocusedOut = false
            , $input = $self.find('.input')
            , phoneCode
        ;
        $self.on('validate', () => {
            const validationErrors = []
            ;
            state.valid = true;
            for (let i = 0; i < validationTypes.length; i++) {
                const value = $input.attr('type') === 'checkbox' ? $input.prop('checked') : $input.val();

                if (!validate(value, VALIDATION_TYPES[validationTypes[i]], { phoneCode })) {
                    validationErrors.push(dictionary[`error_${validationTypes[i]}`].replace("%1", $label.text()));
                    state.valid = false;
                }
            }
            if (state.valid === false) {
                $error.text(validationErrors.join("; "));
            }
            $self.toggleClass('input-block_valid', state.valid)
                .toggleClass('input-block_invalid', !state.valid);
        });
        $self.on('clean', () => {
            $input.val('').trigger('focusout');
            $self.removeClass('input-block_valid input-block_invalid');
            $self.find('.dropdown__dropdown > ul > li.active').removeClass('active');
        });
        if (liveValidation) {
            $input.on('keyup cut paste', () => {
                if (wasFocusedOut) {
                    $self.trigger('validate');
                }
            });
        }
        if (dropdownItemsArray.length) {
            if (isMobile && !isAutocomplete) {
                // create <select> element instead
                const $select = $(`<select class="input">
                    ${dropdownItemsArray.map(item => `<option>${item}</option>`).join('\r\n')}
                </select>`),
                    propsToCopy = ["name", "id"]
                ;
                for (let i = 0; i < propsToCopy.length; i++) {
                    const key = [propsToCopy[i]];
                    if ($input[0][key]) {
                        $select[0][key] = $input[0][key];
                    }
                }
                $input.replaceWith($select);
                $input = $select;
                $select[0].selectedIndex = -1;
            } else {
                // for desktop, customized dropdown as select
                let isBusy = false;
                let autocompleteDisabled = false;
                el.classList.add('dropdown');
                if (!isAutocomplete) {
                    $self.on('dropdownToggle', (e, isOpened) => {
                        if (isBusy) {
                            isBusy = false;
                        } else {
                            $input.trigger(isOpened ? 'focusin' : 'focusout');
                        }
                    })
                }
                $self.on('dropdownChange', (e, activeItem) => {
                    autocompleteDisabled = true;
                    $input.val(activeItem).trigger('paste');
                    autocompleteDisabled = false;
                    $input.trigger('focusout');
                }).dropdown({
                    activeItemEnabled: true,
                    itemsArray: dropdownItemsArray
                });

                if (isAutocomplete) {
                    $input.on('keyup cut paste', () => {
                        if (autocompleteDisabled) return;
                        const escapedValue = $input.val().replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
                        const regex = new RegExp(escapedValue, 'i');
                        const matches = dropdownItemsArray.filter(el => regex.test(el));
                        $self.trigger('setItemsArray', [matches]);
                    });
                }

                $input.on('focusin', () => {
                    if (!isAutocomplete) {
                      $input.blur();
                      isBusy = true;
                    }
                    $self.trigger('dropdownToggle', [true]);
                });
            }
        }
        $input.on('focusin focusout', e => {
            $label.toggleClass('label_scaled', !!$input.val() || e.type === "focusin");
            $self.toggleClass('input-block_focused', !!$input.val() || e.type === "focusin");
            if (liveValidation && !wasFocusedOut && e.type === 'focusout') {
                wasFocusedOut = true;
                $self.trigger('validate');
            }
        });
        if ($self.data('type') === "date" && !detectEditMode()) {
            $.fn.datepicker.languages[datepickerLanguage] = window.config.dictionary[datepickerLanguage];
            const datepickerContainer = document.createElement('div');
            datepickerContainer.className = "input-block__datepicker";
            el.appendChild(datepickerContainer);

            $input.datepicker({
                template: document.getElementById('datepicker-template').innerHTML,
                language: datepickerLanguage,
                offset: 0.01,
                format: 'dd.mm.yyyy',
                inline: true,
                container: datepickerContainer,
                startDate: Date.now()
            })
                .on('focusin', () => {
                    $input.blur();
                    datepickerContainer.style.display = 'block';
                    $self.addClass('input-block_focused');
                })
                .on('pick.datepicker', e => {
                    if (e.view === 'day') {
                        datepickerContainer.style.display = 'none';
                    }
                });
            datepickerContainer.style.display = 'none';
            $(document.body).on('click', e => {
                if (!$(e.target).closest(el).length) {
                    datepickerContainer.style.display = 'none';
                    $input.trigger('focusout');
                }
            })
        }
        if ($self.data('type') === "checkbox") {
            const checkboxSync = () => $self.toggleClass('input-block_checked', $input[0].checked)
                .trigger("checkboxChange", [$input[0].checked]);
            $input.change(checkboxSync);
            checkboxSync();
        }
        if (isPhone) {
            const $codesDropdown = $(`
              <div class="input-block">
                <div class="input-block__input">
                  <input class="input" name="code" value="+"/>
                </div>
              </div>
            `).whitesquareInputBlock({
              dropdownItemsArray: codes,
              type: 'autocomplete',
            }).on('dropdownChange', (e, code) => {
              phoneCode = code;
              if (liveValidation) {
                  $self.trigger('validate');
              }
            });

            $(`
                <div class="grid-x">
                  <div class="small-4 cell"></div>
                  <div class="small-8 cell"></div>
                </div>
            `).insertAfter($self)
              .find('.small-4').append($codesDropdown).end()
              .find('.small-8').append($self);
        }
    })
};

$.fn.whitesquareForm = function (config = {}) {
    if (!window.whitesquareForm) {
        window.whitesquareForm = {$currentForm: $()};
        window.whitesquareFormCallback = token => {
            window.whitesquareForm.$currentForm.trigger('progressStart', [token]);
        };
    }
    const globals = window.whitesquareForm;
    return this.each((i, el) => {
        const $self = $(el)
            , $inputBlocks = $(el).find('.input-block')
            , {
                captchaKey = null,
                minProgressDuration = null,
                captchaCallback = new Function(),
                captchaBadge = "bottomright",
                captchaType = "image",
                captchaZIndex = 2,
                doAjax = true,
                fromUrl = false,
                fromUrlInputName = "from_url"
            } = Object.assign({}, config, $self.data())
        ;
        $inputBlocks.whitesquareInputBlock(config);
        $self.on('submit', e => {
            e.preventDefault();
            $inputBlocks.trigger('validate');
            if (isValid()) {
                globals.$currentForm = $self;
                if (captchaKey) {
                    grecaptcha.execute();
                } else {
                    $self.trigger('progressStart');
                }
            }
        });
        if (captchaKey) {
            const script = document.createElement('script');
            $(document.body).append(script);
            script.onload = () => {
                $('.contact-form').append($('<div />', {
                    class: 'g-recaptcha',
                    'data-sitekey': captchaKey,
                    'data-callback': 'whitesquareFormCallback',
                    'data-size': 'invisible',
                    'data-badge': captchaBadge,
                    'data-type': captchaType,
                    style: `position: relative; z-index: ${captchaZIndex};`
                }));
            };
            script.src = CAPTCHA_API;
        }
        $self.on('progressStart', (e, token) => {
            if (!doAjax) {
                return setTimeout(() => $self.trigger('progressEnd'), minProgressDuration || 5);
            }
            let minProgressPassed = !minProgressDuration
                , ajaxData
            ;
            if (minProgressDuration) {
                setTimeout(() => {
                    minProgressPassed = true;
                    if (ajaxData) {
                        $self.trigger('progressEnd', [ajaxData]);
                    }
                }, minProgressDuration);
            }

            const formData = new FormData();

            $self.find('input[type="file"]').each((i, el) => {
                Array.prototype.forEach.call(el.files, file => {
                    formData.append(el.getAttribute('name'), file);
                });
            });

            const otherData = $self.serializeArray();
            $.each(otherData,function(key, input) {
                formData.append(input.name, input.value);
            });

            $.ajax({
                url: $self.attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    ajaxData = data;
                    console.log(ajaxData);
                    if (minProgressPassed) {
                        $self.trigger('progressEnd', [ajaxData]);
                    }
                },
                error: function (data, status, error) {
                    $self.trigger('progressError', [status, error]);
                }
            });

            if (captchaKey) {
                grecaptcha.reset()
            }
            captchaCallback(token);
        });
        $self.on('progressEnd', () => $inputBlocks.trigger('clean'));
        function isValid() {
            return $inputBlocks.toArray()
                .reduce((prev, curr) => prev && curr.inputBlock && curr.inputBlock.valid, true);
        }

        if (fromUrl) {
            $self.append(`<input type="hidden" name="${fromUrlInputName}" value="${window.location}" />`);
        }
    })
};
