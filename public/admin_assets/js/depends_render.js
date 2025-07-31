var globalPriceFormulas = [];

function setupDependsOn(form) {
    let processedElements = [];
    let priceProcessedElements = [];
    $('[dependson_code]').each(function () {
        let fieldInfo = getFieldInformation($(this));        
        if (!processedBefore(fieldInfo.field_wrapper.get(0), processedElements)) {
            processedElements.push(fieldInfo.field_wrapper.get(0));
            fieldInfo.field_wrapper.css('display', 'none');
            // Process the dependson_code
            let bits = fieldInfo.dependson_code.split(':');
            let dependson_option_type = bits.shift();
            let dependson_field_name = bits.shift();
            let dependson_option_value = bits.shift();
            let dependson_state = bits.length > 0 ? bits.shift() : "";

            if (dependson_option_type == 'select') {
                let select_box = $('select[id=' + dependson_field_name + ']').first();
                if (select_box.length) {
                    let handler = function () {
                        let selected = select_box.children("option:selected").val();
                        if (selected == dependson_option_value) {
                            availableToggle(fieldInfo, true, select_box);
                        } else {
                            availableToggle(fieldInfo, false, select_box);
                        }
                    };
                    handler();
                    select_box.change(handler);
                }
            } else if (dependson_option_type == 'checkbox-group') {
                let checkboxes = $('input[type=checkbox][name="' + dependson_field_name + '[]"]');
                let handler = function () {
                    checkboxes.each(function () {
                        if ($(this).val() == dependson_option_value) {
                            if ($(this).prop('checked') == (dependson_state == 'checked')) {
                                availableToggle(fieldInfo, true, checkboxes);
                            } else {
                                availableToggle(fieldInfo, false, checkboxes);
                            }
                        }
                    });
                };
                handler();
                checkboxes.each(function () {
                    $(this).click(handler);
                });
            } else if (dependson_option_type == 'radio-group') {
                let radiobutton = $('input[type=radio][name="' + dependson_field_name + '"]');
                let handler = function () {
                    let checked_button = $('input[type=radio][name="' + dependson_field_name + '"]:checked');
                    if (checked_button.val() == dependson_option_value) {
                        availableToggle(fieldInfo, true, radiobutton);
                    } else {
                        availableToggle(fieldInfo, false, radiobutton);
                    }
                };
                handler();
                radiobutton.change(handler);
            }
        }
    });

    $('[price_formula_value]').each(function () {
        let fieldInfo = getFieldInformation($(this));
        if (!processedBefore(fieldInfo.field_wrapper.get(0), priceProcessedElements)) {
            priceProcessedElements.push(fieldInfo.field_wrapper.get(0));
            // Store the field's price formula info globally.
            globalPriceFormulas.push({
                wrapper: fieldInfo.field_wrapper,
                field: fieldInfo.field,
                mapping: fieldInfo.price_formula // e.g., "customer-pickup:0,goatlas-install:125"
            });
            attachPriceHandlers(fieldInfo);
            // Update the global price display on initial load.
            updateGlobalPriceDisplay();
        }
    });

    $('input[type="file"]').each(function() {
        $(this).after('<div class="file-size-notice" style="font-size: 0.8em; color: #666; margin-top: 5px;">Maximum file size: 50 MB</div>');
    });

    updateCartLockButton()
}

function updateCartLockButton() {
    let disableCart = false;
    // Loop over all fields that support cart lock.
    // We assume such fields have an attribute cart_lock="yes"
    $("[cart_lock='enable']").each(function() {
        let $field = $(this);
        let selectedOption = '';
        // Determine the selected option based on field type
        if ($field.is('select')) {
            selectedOption = $field.find('option:selected').val();
        } else if ($field.is('input[type=radio]')) {
            // For radio groups, select the checked radio within the same name.
            selectedOption = $("[name='" + $field.attr('name') + "']:checked").val();
        } else if ($field.is('input[type=checkbox]')) {
            // For checkbox groups, we can either sum or pick the first;
            // here, we'll check the first checked value.
            selectedOption = $("[name='" + $field.attr('name') + "']:checked").first().val();
        }
        // Get the mapping string from the attribute "cart_lock_value"
        let mapping = $field.attr('cart_lock_value') || '';
        let status = extractCartLockStatus(mapping, selectedOption);
        if (status === 'block') {
            disableCart = true;
            return false; // break out of each loop
        }
    });

    let disableShipping = false;
    $("[shipping_disable='yes']").each(function() {
        let $field = $(this);
        let selectedOption = '';
        // Determine the selected option based on field type
        if ($field.is('select')) {
            selectedOption = $field.find('option:selected').val();
        } else if ($field.is('input[type=radio]')) {
            // For radio groups, select the checked radio within the same name.
            selectedOption = $("[name='" + $field.attr('name') + "']:checked").val();
        } else if ($field.is('input[type=checkbox]')) {
            // For checkbox groups, we can either sum or pick the first;
            // here, we'll check the first checked value.
            selectedOption = $("[name='" + $field.attr('name') + "']:checked").first().val();
        }
        // Get the mapping string from the attribute "cart_lock_value"
        let mapping = $field.attr('shipping_disable_value') || '';
        let status = extractShippingDisableStatus(mapping, selectedOption);
        if (status === 'block') {
            disableShipping = true;
            return false; // break out of each loop
        }
    });

    // Set the Add-to-Cart button disabled state accordingly.
    $(".add-to-cart-button").prop("disabled", disableCart);
    $("#shipping_disable").val(disableShipping);
}

function extractCartLockStatus(mapping, optionValue) {
    if (!mapping || !optionValue) return 'none';
    let pairs = mapping.split(',');
    for (let pair of pairs) {
        let [opt, status] = pair.split(':');
        if (opt.trim() === optionValue) {
            return status.trim();
        }
    }
    return 'none';
}


function extractShippingDisableStatus(mapping, optionValue) {
    if (!mapping || !optionValue) return 'none';
    let pairs = mapping.split(',');
    for (let pair of pairs) {
        let [opt, status] = pair.split(':');
        if (opt.trim() === optionValue) {
            return status.trim();
        }
    }
    return 'none';
}


// // The mapping string is stored in the price_formula_value attribute (e.g., "customer-pickup:0,goatlas-install:125")
// function updatePriceFormula(fieldInfo) {
//     let mapping = fieldInfo.price_formula; 
//     if (!mapping) return;
    
//     let selectedOption = '';
//     if (fieldInfo.field.is('select')) {
//         selectedOption = fieldInfo.field.find('option:selected').val();
//     } else if (fieldInfo.field.is('input[type=radio]')) {
//         selectedOption = $('input[type=radio][name="' + fieldInfo.field.attr('name') + '"]:checked').val();
//     } else if (fieldInfo.field.is('input[type=checkbox]')) {
//         selectedOption = $('input[type=checkbox][name="' + fieldInfo.field.attr('name') + '[]"]:checked').first().val();
//     }
//     let price = extractPrice(mapping, selectedOption);
//     console.log(mapping);
//     console.log(price);
//     console.log(fieldInfo);
//     $('.product-price').text($('.product-price').text()+'+'+price);
//     $('.price-addon').val(price);
// }

// // Utility: Parses the mapping string and returns the price for the given option.
// function extractPrice(mapping, optionValue) {
//     if (!mapping || !optionValue) return '';
//     let pairs = mapping.split(',');
//     for (let pair of pairs) {
//         let [opt, price] = pair.split(':');
//         if (opt === optionValue) {
//             return price;
//         }
//     }
//     return '';
// }

// Attach change handlers (scoped to the field's wrapper) so that changes update the global price.
function attachPriceHandlers(fieldInfo) {
    if (fieldInfo.field.is('select')) {
        fieldInfo.field.change(function () {
            updateGlobalPriceDisplay();
            updateCartLockButton();
        });
    } else if (fieldInfo.field.is('input[type=radio]')) {
        fieldInfo.field_wrapper.find('input[type=radio][name="' + fieldInfo.field.attr('name') + '"]').change(function () {
            updateGlobalPriceDisplay();
            updateCartLockButton();
        });
    } else if (fieldInfo.field.is('input[type=checkbox]')) {
        fieldInfo.field_wrapper.find('input[type=checkbox][name="' + fieldInfo.field.attr('name') + '"]').change(function () {
            updateGlobalPriceDisplay();
            updateCartLockButton();
        });
    }
}

function updateGlobalPriceDisplay() {
    let totalPrice = 0;
    globalPriceFormulas.forEach(function (item) {
        // Skip fields that are hidden.
        if (!item.wrapper.is(':visible')) {
            return;
        }

        let selectedOption = '';
        if (item.field.is('select')) {
            selectedOption = item.field.find('option:selected').val();
        } else if (item.field.is('input[type=radio]')) {
            selectedOption = item.wrapper.find('input[type=radio][name="' + item.field.attr('name') + '"]:checked').val();
        } else if (item.field.is('input[type=checkbox]')) {
            // Assuming checkboxes use name ending with "[]"
            selectedOption = item.wrapper.find('input[type=checkbox][name="' + item.field.attr('name') + '"]:checked').first().val();
        }
        let priceStr = extractPrice(item.mapping, selectedOption);
        let price = parseFloat(priceStr) || 0;
        totalPrice += price;
    });
    // Update the single global elements by their unique IDs
    if(totalPrice > 0){
        totalPrice = totalPrice.toFixed(2) || 0;
    }
    $('.product-price').text('$' + totalPrice);
    $('.product-price-no-addons').show();
    // Convert the existing text to a number; if empty or non-numeric, use 0
    var currentPrice = ($('.product-real-price').data('product-price')) || 0;
    var currentPrice = parseFloat((+currentPrice + +totalPrice)).toFixed(2);
    var formattedPrice = parseFloat(currentPrice).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    $('.product-real-price').text('$' + formattedPrice);

    $('.price-addon').val(totalPrice);
}


// Utility: Given a mapping string (e.g., "customer-pickup:0,goatlas-install:125") and an option value,
// returns the corresponding price.
function extractPrice(mapping, optionValue) {
    if (!mapping || !optionValue) return '';
    let pairs = mapping.split(',');
    for (let pair of pairs) {
        let [opt, price] = pair.split(':');
        if (opt === optionValue) {
            return price;
        }
    }
    return '';
}

function availableToggle(fieldInfo, available, fieldContainer) {
    if (available) {
        fieldInfo.field_wrapper.slideDown('slow', 'swing', function () {
            // If the field has a price formula, update the global price.
            if (fieldInfo.price_formula) {
                updateGlobalPriceDisplay();
            }
        });

        if (fieldInfo.field.attr('type') === 'checkbox' || fieldInfo.field.attr('type') === 'radio') {
            // Enable all inputs in the group
            $('input[name="' + fieldInfo.field.attr('name') + '"]').each(function () {
                $(this).prop('disabled', false);
            });
        } else {
            fieldInfo.field.prop('disabled', false);
        }
    } else {
        fieldInfo.field_wrapper.slideUp('slow', 'swing', function () {
            // Optionally, update global price if a field goes hidden.
            updateGlobalPriceDisplay();
        });
        if (fieldInfo.field.attr('type') === 'checkbox' || fieldInfo.field.attr('type') === 'radio') {
            $('input[name="' + fieldInfo.field.attr('name') + '"]').each(function () {
                $(this).prop('disabled', true);
            });
        } else {
            fieldInfo.field.prop('disabled', true);
        }
    }
    updateCartLockButton();
}

function getFieldInformation(field) {
    let info = {
        field: field,
        name: field.attr('name') || '',
        dependson_code: field.attr('dependson_code'),
        price_formula: field.attr('price_formula_value')
    };
    if (field.is('p') || field.is('h1')) {
        info.field_wrapper = info.field.parent();
    } else {
        if (info.field.attr('type') && info.field.attr('type') == 'hidden') {
            info.field_wrapper = info.field;
            info.field_type = info.field.attr('type');
        } else {
            info.field_wrapper = info.field.closest('.form-group');
            info.field_type = info.field_wrapper.attr('class').match(/formbuilder-([^\s]+)/)[1];
        }
    }
    return info;
}

function processedBefore(field, processedElements) {
    for (let i = 0; i < processedElements.length; i++) {
        if (field === processedElements[i]) {
            return true;
        }
    }
    return false;
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
