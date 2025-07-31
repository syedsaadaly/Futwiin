function addDependsOn(options) {
    const typeUserAttrs = {
        dependson_type: {
            label: 'Available',
            options: {
                '': 'All the Time',
                'checkbox-group': 'checkbox-group',
                'select': 'select',
                'radio-group': 'radio-group',
            }
        },
        dependson_code: {
            value: '',
        },
        price_formula_available: {
            label: 'Price Formula Available',
            options: {
                'no': 'No',
                'yes': 'Yes'
            }
        },
        price_formula_value: {
            value: ''
        },
        cart_lock: {
           label: 'Disable Add to Cart Button',
           options: {
               'disable': 'Disable',
               'enable': 'Enable'
           }
        },
        cart_lock_value: {
           value: ''
        },
        shipping_disable: {
           label: 'Disable Shipping On Options:',
           options: {
               'No': 'No',
               'yes': 'Yes'
           }
        },
        shipping_disable_value: {
           value: ''
        }
    };
    const typeUserEvents = {
        onadd: function (fld) {
            $('.dependson_code-wrap').addClass('collapse');
            const type_selector = $('.fld-dependson_type', fld);
            const code_selector = $('.fld-dependson_code', fld);
            const my_field_name = $('.fld-name', fld).val();
            setTimeout(function () {
                setDependsOptionName(code_selector.val(), type_selector);
            }, 1000);
            type_selector.change(function (e) {
                const selected = $(this).children("option:selected").val();
                if (selected.length > 0) {
                    $('#depends_on_field').empty();
                    $('.form-builder .form-field[type=' + selected + ']').each(function () {
                        let field_value = $('.fld-name', this).val();
                        let field_name = $('.fld-label', this).html();
                        if (field_value != my_field_name) {
                            $('#depends_on_field').append(new Option(field_name, field_value));
                        }
                    });
                    $('#depends_on_checkbox-group').css('display', 'none');
                    $('#depends_on_radio-group').css('display', 'none');
                    $('#depends_on_select').css('display', 'none');
                    $('#depends_on_' + selected).css('display', 'flex');
                    setOptions('#depends_on_field', '#depends_on_' + selected + '_container', selected);
                    $('#depends_on_field').change(function (e) {
                        setOptions('#depends_on_field', '#depends_on_' + selected + '_container', selected);
                    });
                    $('#modal-form-dependson button[name=depends-on-save]').click(function () {
                        $('#modal-form-dependson button[name=depends-on-save]').off('click');
                        DependsOnSave('#depends_on_field', '#depends_on_' + selected + '_container', selected, code_selector, type_selector);
                    });
                    $('#modal-form-dependson').on('hide.bs.modal', function (e) {
                        $('#modal-form-dependson').off('hide.bs.modal');
                        console.log($('#modal-form-dependson'));
                        setDependsOptionName(code_selector.val(), type_selector);
                    });
                    $('#modal-form-dependson').modal('show');
                } else {
                    code_selector.val("");
                }
            });

            $('.price_formula_value-wrap').addClass('collapse');
            const formula_selector = $('.fld-price_formula_available', fld);
            const formula_value = $('.fld-price_formula_value', fld);
            const field_type = $(fld).attr('type');
            
            formula_value.on('click',function () {
                const selected = formula_selector.val();
                if (selected === 'yes' && ['checkbox-group', 'radio-group', 'select'].includes(field_type)) {
                    showPriceFormulaModal(fld, formula_value);
                }
            });
            formula_selector.change(function () {
                const selected = $(this).val();
                if (selected == 'yes' && ['checkbox-group', 'radio-group', 'select'].includes(field_type)) {
                    showPriceFormulaModal(fld, formula_value);
                } else {
                    formula_value.val('');
                }
            });

            // CART LOCK HANDLING
            $('.cart_lock_value-wrap').addClass('collapse');
            const cartLockSelector = $('.fld-cart_lock', fld);
            const cartLockValue = $('.fld-cart_lock_value', fld);
            cartLockValue.on('click', function () {
                if (cartLockSelector.val() === 'enable') {
                    showCartLockModal(fld, cartLockValue);
                }
            });
            cartLockSelector.change(function () {
                if ($(this).val() == 'enable') {
                    showCartLockModal(fld, cartLockValue);
                } else {
                    cartLockValue.val('');
                }
            });

            // SHIPPING DISABLE HANDLING
            $('.shipping_disable_value-wrap').addClass('collapse');
            const shippingDisableSelector = $('.fld-shipping_disable', fld);
            const shippingDisableValue = $('.fld-shipping_disable_value', fld);
            shippingDisableValue.on('click', function () {
                if (shippingDisableSelector.val() === 'yes') {
                    showShippingDisableModal(fld, shippingDisableValue);
                }
            });
            shippingDisableSelector.change(function () {
                if ($(this).val() == 'yes') {
                    showShippingDisableModal(fld, shippingDisableValue);
                } else {
                    shippingDisableValue.val('');
                }
            });

            $(fld).find('.option-value').each(function () {
                ensureUniqueOptionValue($(this), fld);
                $(this).attr('data-old-value', $(this).val());
            });

            $(fld).on('change', '.option-label, .option-value', function () {
                handleOptionValueChange(fld, formula_value, cartLockValue);
            });

            if ($(fld).attr('type') === 'paragraph') {
                setTimeout(function () {
                    const textarea = $(fld).find('.label-wrap .form-control');
                    if (textarea.length && !textarea.hasClass('summernote-applied')) {
                        textarea.addClass('summernote-applied');
                        textarea.summernote({
                            height: 150,
                            toolbar: [
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']]
                            ],
                            callbacks: {
                                onChange: function(contents) {
                                    // Update the hidden div with the new content
                                    $(fld).find('.fld-label').html(contents);
                                }
                            }
                        });
                    }
                }, 200);
            }
        }
    };
    if (!options.typeUserAttrs) options.typeUserAttrs = {};
    if (!options.typeUserEvents) options.typeUserEvents = {};


    getControlList().forEach(function (item, index) {
        if (!options.typeUserAttrs[item]) options.typeUserAttrs[item] = {};
        if (!options.typeUserEvents[item]) options.typeUserEvents[item] = {};
        options.typeUserAttrs[item].dependson_type = typeUserAttrs.dependson_type;
        options.typeUserAttrs[item].dependson_code = typeUserAttrs.dependson_code;
        // options.typeUserAttrs[item].price_formula_available = typeUserAttrs.price_formula_available;
        // options.typeUserAttrs[item].price_formula_value = typeUserAttrs.price_formula_value;
        options.typeUserEvents[item].onadd = typeUserEvents.onadd;
    });

    getPriceControlList().forEach(function (item, index) {
        options.typeUserAttrs[item].price_formula_available = typeUserAttrs.price_formula_available;
        options.typeUserAttrs[item].price_formula_value = typeUserAttrs.price_formula_value;
        options.typeUserAttrs[item].cart_lock = typeUserAttrs.cart_lock;
        options.typeUserAttrs[item].cart_lock_value = typeUserAttrs.cart_lock_value;
        options.typeUserAttrs[item].shipping_disable = typeUserAttrs.shipping_disable;
        options.typeUserAttrs[item].shipping_disable_value = typeUserAttrs.shipping_disable_value;
    });

    return options;
}

function showCartLockModal(fld, cartLockValue) {
    $('#cart_lock_options').empty();
    $(fld).find('.option-value').each(function () {
        const option_label = $(this).closest('li').find('.option-label').val();
        const option_value = $(this).val();
        ensureUniqueOptionValue($(this), fld);
        // Check if there's an existing mapping in cartLockValue
        let existingMapping = cartLockValue.val();
        let existingStatus = extractCartLockStatus(existingMapping, option_value);
        $('#cart_lock_options').append(`
            <div class="form-group">
                <label>
                    <input type="checkbox" class="cartlock-checkbox" data-option="${option_value}" ${existingStatus === 'block' ? 'checked' : ''}>
                    ${option_label}
                </label>
            </div>
        `);
    });
    const modal = $('#modal-form-cartlock');
    modal.modal({ backdrop: 'static', keyboard: false }).modal('show');
    modal.find('button[name=cartlock-save]').off('click').click(function () {
        let mappingArr = [];
        $('.cartlock-checkbox').each(function () {
            let opt = $(this).data('option');
            let status = $(this).is(':checked') ? 'block' : 'none';
            mappingArr.push(`${opt}:${status}`);
        });
        cartLockValue.val(mappingArr.join(','));
        modal.modal('hide');
    });
    modal.find('button[name=cartlock-cancel]').off('click').click(function () {
        if (!cartLockValue.val().trim()) {
            $('.fld-cart_lock', fld).val('disable').trigger('change');
        }
        modal.modal('hide');
    });
}

function extractCartLockStatus(mapping, optionValue) {
    if (!mapping) return 'none';
    let pairs = mapping.split(',');
    for (let pair of pairs) {
        let [opt, status] = pair.split(':');
        if (opt === optionValue) {
            return status;
        }
    }
    return 'none';
}

function showShippingDisableModal(fld, shippingDisableValue) {
    $('#shipping_disable_options').empty();
    $(fld).find('.option-value').each(function () {
        const option_label = $(this).closest('li').find('.option-label').val();
        const option_value = $(this).val();
        ensureUniqueOptionValue($(this), fld);
        // Check if there's an existing mapping in shippingDisableValue
        let existingMapping = shippingDisableValue.val();
        let existingStatus = extractShippingDisableStatus(existingMapping, option_value);
        $('#shipping_disable_options').append(`
            <div class="form-group">
                <label>
                    <input type="checkbox" class="shipping-checkbox" data-option="${option_value}" ${existingStatus === 'block' ? 'checked' : ''}>
                    ${option_label}
                </label>
            </div>
        `);
    });
    const modal = $('#modal-form-shipping');
    modal.modal({ backdrop: 'static', keyboard: false }).modal('show');
    modal.find('button[name=shipping-save]').off('click').click(function () {
        let mappingArr = [];
        $('.shipping-checkbox').each(function () {
            let opt = $(this).data('option');
            let status = $(this).is(':checked') ? 'block' : 'none';
            mappingArr.push(`${opt}:${status}`);
        });
        shippingDisableValue.val(mappingArr.join(','));
        modal.modal('hide');
    });
    modal.find('button[name=shipping-cancel]').off('click').click(function () {
        if (!shippingDisableValue.val().trim()) {
            $('.fld-shipping_disable', fld).val('disable').trigger('change');
        }
        modal.modal('hide');
    });
}

function extractShippingDisableStatus(mapping, optionValue) {
    if (!mapping) return 'none';
    let pairs = mapping.split(',');
    for (let pair of pairs) {
        let [opt, status] = pair.split(':');
        if (opt === optionValue) {
            return status;
        }
    }
    return 'none';
}


function showPriceFormulaModalOld(fld, formula_value) {
    $('#price_formula_options').empty();
    const field_type = $(fld).attr('type');
        
    $('.form-builder .form-field[type=' + field_type + '] .option-value', fld).each(function () {
        const option_label = $(this).closest('li').find('.option-label').val();
        const option_value = $(this).val();
        $('#price_formula_options').append(`
            <div class="form-group">
                <label>${option_label}</label>
                <input type="number" class="form-control price-input" data-option="${option_value}" placeholder="Enter price">
            </div>
        `);
    });

    $('#modal-form-price').modal('show');
    $('#modal-form-price button[name=price-formula-save]').off('click').click(function () {
        let priceData = [];
        $('.price-input').each(function () {
            let opt = $(this).data('option');
            let price = $(this).val();
            if (price) {
                priceData.push(`${opt}:${price}`);
            }
        });
        formula_value.val(priceData.join(','));
        $('#modal-form-price').modal('hide');
    });
}

function showPriceFormulaModal(fld, formula_value) {
    $('#price_formula_options').empty();
    const field_type = $(fld).attr('type');
    const formula_selector = $('.fld-price_formula_available', fld);
    
    $(fld).find('.option-value').each(function () {
        const option_label = $(this).closest('li').find('.option-label').val();
        const option_value = $(this).val();
        ensureUniqueOptionValue($(this), fld);

        const existingFormula = formula_value.val();
        const existingPrice = extractPrice(existingFormula, option_value);

        $('#price_formula_options').append(`
            <div class="form-group">
                <label>${option_label}</label>
                <input type="number" class="form-control price-input" data-option="${option_value}" placeholder="Enter price" value="${existingPrice}">
            </div>
        `);
    });

    // Show modal and allow closing by clicking outside
    const modal = $('#modal-form-price');
    modal.modal({
        backdrop: 'static',
        keyboard: false
    });

    // Save button logic
    $('#modal-form-price button[name=price-formula-save]').off('click').click(function () {
        updatePriceFormula(fld, formula_value);
        modal.modal('hide');
    });

    // Close modal by clicking outside
    modal.off('click.dismiss').on('click.dismiss', function (event) {
        if ($(event.target).is('#modal-form-price')) {
            resetPriceFormulaIfEmpty(formula_selector, formula_value);
        }
    });

    // Handle cancel button click
    $('#modal-form-price button[name=price-formula-cancel]').off('click').click(function () {
        resetPriceFormulaIfEmpty(formula_selector, formula_value);
        modal.modal('hide');
    });
}

// Function to reset Price Formula to "No" if no values are added
function resetPriceFormulaIfEmpty(formula_selector, formula_value) {
    if (!formula_value.val().trim()) {
        formula_selector.val('no').trigger('change');
    }
}

function updatePriceFormula(fld, formula_value) {
    let priceData = [];
    $('.price-input').each(function () {
        let opt = $(this).data('option');
        let price = $(this).val();
        if (price) {
            priceData.push(`${opt}:${price}`);
        }
    });
    formula_value.val(priceData.join(','));
}

function extractPrice(formula, optionValue) {
    let pairs = formula.split(',');
    for (let pair of pairs) {
        let [opt, price] = pair.split(':');
        if (opt === optionValue) {
            return price;
        }
    }
    return '';
}

function getPriceControlList() {
    return ['checkbox-group', 'radio-group', 'select'];
}

function getControlList() {
    return ['button', 'checkbox-group', 'date', 'file', 'hidden', 'number', 'paragraph', 'radio-group', 'select', 'text', 'textarea'];
}

function setDisabledDefaults(list) {
    let obj = {};
    list.forEach(function (item, index) {
        obj[item] = ['access'];
    });
    return obj;
}

function DependsOnSave(src_select_field, dst_select_field, option_type, code_selector, type_selector) {
    let field_name = $(src_select_field).children('option:selected').val();
    let option_value = $(dst_select_field).children('option:selected').val();
    let action = "";
    let code = option_type + ":" + field_name + ":" + option_value;
    if (option_type == 'checkbox-group') {
        action = $('#depends_on_checkbox_checkbox').is(":checked") ? 'checked' : 'unchecked';
        code += ':' + action;
    }
    code_selector.val(code);
    code_selector.prop('readonly', true);
    setDependsOptionName(code, type_selector);
    $('#modal-form-dependson').modal('hide');
}

function resetDependsOptionNames(type_selector) {
    $(type_selector).children('option').each(function () {
        if ($(this).val() == 'checkbox-group') {
            $(this).text("when checkbox ....");
        } else if ($(this).val() == 'radio-group') {
            $(this).text("when radio button ....");
        } else if ($(this).val() == 'select') {
            $(this).text("when select option ....");
        }
    });
}

function setDependsOptionName(code, type_selector) {
    let type_selector_option = null;
    resetDependsOptionNames(type_selector);
    if (code.length > 0) {
        let bits = code.split(":");
        let option_type = bits.shift();
        let field_name = bits.shift();
        let option_value = bits.shift();
        let action = "";

        let name = "when ";
        let field_container = $(`.fld-name[value='${field_name}']`).closest('.form-elements');
        let option_container = $(`.option-value[value='${option_value}']`, field_container).closest('li');
        if (option_type == 'checkbox-group') {
            name += " checkbox "
            action = bits.shift();
        } else if (option_type == 'radio-group') {
            name += " radio button ";
            action = 'chosen';
        } else if (option_type == 'select') {
            name += " select option ";
            action = 'selected';
        }

        name += $('.fld-label', field_container).html() + " -> " + $('.option-label', option_container).val() + " is " + action;
        type_selector_option = $(type_selector).children(`option[value="${option_type}"]`);
        type_selector_option.text(name);
    } else {
        type_selector_option = $(type_selector).children('option[value=""]');
    }
    type_selector_option.prop('selected', true);
}

function handleCartLockValueChange(fld, cartLockValue) {
    // Check if Cart Lock is enabled (value is 'yes')
    

    // Retrieve existing mapping from cartLockValue

    // Loop through option values within the current field (scoped to fld)
    $(fld).find('.option-value').each(function () {
        let oldOption = $(this).attr('data-old-value') || $(this).val();
        let newOption = $(this).val().trim();
        ensureUniqueOptionValue($(this), fld);
        $(this).attr('data-old-value', newOption);
        // Extract previous cart lock status from old mapping (default to 'none')
        
    });
}


function handleOptionValueChange(fld, formula_value, cartLockValue) {
    let formulaEnabled = $(fld).find('.fld-price_formula_available').val() === 'yes';
    let cartLockStatus = $(fld).find('.fld-cart_lock').val();

    let newFormula = [];
    let oldFormula = formula_value.val().split(',');
    let priceMap = {};
    let oldMapping = cartLockValue.val();
    let newMappingArr = [];

    oldFormula.forEach(entry => {
        let [opt, price] = entry.split(':');
        priceMap[opt] = price;
    });

    let optionValues = new Set(); // Track unique option values
 
    $(fld).find('.option-value').each(function () {
        let oldOption = $(this).attr('data-old-value') || $(this).val(); // Get old value before change
        let newOption = $(this).val().trim();
        ensureUniqueOptionValue($(this), fld);
        let price = priceMap[oldOption] || 0;

        optionValues.add(newOption);

        $(this).val(newOption); // Update field with unique value
        $(this).attr('data-old-value', newOption); // Store new value as old for future tracking

        let status = extractCartLockStatus(oldMapping, oldOption);
        if (!status) status = 'none';
        newMappingArr.push(`${newOption}:${status}`);

        newFormula.push(`${newOption}:${price}`);
    });

    if (formulaEnabled){
        formula_value.val(newFormula.join(','));
    }

    if (cartLockStatus == 'enable') {
        cartLockValue.val(newMappingArr.join(','));
    }

}

function ensureUniqueOptionValue(input, fld) {
    let option_value = input.val();
    let parentField = $(fld);
    let duplicateCount = parentField.find('.option-value').filter((_, el) => $(el).val() === option_value).length;
    if (duplicateCount > 1) {
        option_value += '-' + Math.floor(Math.random() * 1000);
        input.val(option_value);
    }
}


function handleOptionValueChangeOld(fld, formula_value) {
    let newFormula = [];
    let oldFormula = formula_value.val().split(',');
    let priceMap = {};

    oldFormula.forEach(entry => {
        let [opt, price] = entry.split(':');
        priceMap[opt] = price;
    });

    let optionValues = new Set(); // Track unique option values

    $(fld).find('.option-value').each(function () {
        let newOption = $(this).val().trim();
        let price = priceMap[newOption] || '';

        // Ensure unique option values by adding a random number if needed
        while (optionValues.has(newOption) || newOption === '') {
            newOption += "-" + Math.floor(Math.random() * 1000);
        }
        optionValues.add(newOption);

        $(this).val(newOption); // Ensure the field gets updated with the unique value
        newFormula.push(`${newOption}:${price}`);
    });

    formula_value.val(newFormula.join(','));
}


function setOptions(src_select_field, dst_select_field, option_type) {
    let depends_on_field_name = $(src_select_field).children('option:selected').val();
    let select_box = $(dst_select_field);

    const form = JSON.parse(myFormBuilder.actions.getData('json', true));
    const element = form.find(element => element.name === depends_on_field_name);

    select_box.empty();

    element.values.forEach(function (option) {
        select_box.append(new Option(option.label, option.value));
    });
}




function sanitizeInput(value, replacement) {
    return value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, replacement);
}

// Generic function to handle input sanitization
function handleSanitizeInput(selector, replacement) {
    $(document).on("input paste drop", selector, function (event) {
        var $this = $(this);

        // Wait for the input value to be updated, then sanitize
        setTimeout(function () {
            var sanitized = sanitizeInput($this.val(), replacement);
            $this.val(sanitized);
        }, 0);
    });
}

$(document).on("input paste drop", ".radio-group-field .option-label.option-attr, .select-field .option-label.option-attr, .checkbox-group-field .option-label.option-attr, .autocomplete-field .option-label.option-attr", function (event) {
    var $this = $(this);
    var slug = $(this).parent().find('.option-value');

    // Wait for the input value to be updated, then sanitize
    var sanitized = sanitizeInput($this.val(), '-');
    slug.val(sanitized);
    ensureUniqueOptionValue(slug, $this.parent().closest('.form-elements'));
});

$(document).on("input paste drop", ".form-elements .label-wrap .fld-label", function (event) {
    var $this = $(this);
    var slug = $(this).parent().parent().parent().find('.name-wrap .fld-name');

    // Wait for the input value to be updated, then sanitize
    var sanitized = sanitizeInput($this.text(), '-');
    if (!slug) {
        slug.val(sanitized);
    }
});
// Apply sanitization rules
handleSanitizeInput(".radio-group-field .option-value.option-attr, .select-field .option-value.option-attr, .checkbox-group-field .option-value.option-attr, .autocomplete-field .option-value.option-attr", "-");
handleSanitizeInput(".name-wrap .fld-name", "-");
