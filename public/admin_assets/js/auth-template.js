(function ($) {
    'use strict'

    $('[data-mask]').inputmask();

    $('.select2').select2();

    $('#baseballeventdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

    $('#softballeventdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

    let typingTimer;
    let doneTypingInterval = 1500;

    let street_address_field = '#shipping_street';
    let city_field = '#shipping_city';
    let state_field = '#shipping_state';
    let zip_field = '#shipping_zip';


    // Registration
    $('#registration_form').validate({
        rules: {
            league_name: {
                required: true,
            },
            league_id: {
                required: true,
                integer: true,
                maxlength: 8
            },
            lc_first_name: {
                required: true,
            },
            lc_last_name: {
                required: true,
            },
            lc_phone_no: {
                required: true,
            },
            lc_email: {
                required: true,
                email: true
            },
            lc_league_position: {
                required: true,
                integer: true
            },
            lc_secondary_first_name: {
                required: true,
            },
            lc_secondary_last_name: {
                required: true,
            },
            lc_secondary_phone_no: {
                required: true,
            },
            lc_secondary_email: {
                required: true,
                email: true
            },
            lc_secondary_league_position: {
                required: true,
                integer: true
            },
            shipping_street: {
                required: true,
            },
            shipping_city: {
                required: true,
            },
            shipping_state: {
                required: true,
            },
            shipping_zip: {
                required: true,
            },
            event_type: {
                required: true,
            },
            terms_and_condition_2: {
                required: true,
            },
            terms_and_condition_3: {
                required: true,
            },
            terms_and_condition_4: {
                required: true,
            },
            terms_and_condition_5: {
                required: true,
            },
            terms_and_condition_6: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            email: {
                required: "Please enter a email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    // Fields
    const league_name_field = $('input[name="league_name"]');
    const league_id_field = $('input[name="league_id"]');
    const shipping_city_field = $('input[name="shipping_city"]');
    const shipping_state_field = $('select[name="shipping_state"]');
    const shipping_zip_field = $('input[name="shipping_zip"]');

    $(league_name_field).autoComplete({
        resolver: 'custom',
        events: {
            search: function (query, callback) {
                const filteredLeagues = pre_approved_leagues.filter(league =>
                    league.league_name.toLowerCase().includes(query.toLowerCase())
                ).map(league => ({
                    label: league.league_name,
                    value: league.league_id
                }));
                callback(filteredLeagues);
            }
        },
        formatResult: function (item) {
            return {
                value: item.value,
                text: item.label
            };
        },
        preventEnterSubmit: true
    });

    $(league_name_field).on('autocomplete.select', function (event, item) {
        $(league_id_field).val(item.value);
        $(league_id_field).prop('readonly', true);

        $.ajax({
            url: getLeagueAddressFromPreApprovedLeagues,
            method: 'GET',
            data: {
                league_id: item.value
            },
            success: function (response) {
                $('input[name="verify_address"]').val('');
                $('#fedex_address_response').html('');
                $(street_address_field).val('');
                if(response.status === 'success') {
                    $(shipping_city_field).val(response.data.city);
                    $(shipping_state_field).val(response.data.state).trigger('change');
                    $(shipping_zip_field).val(response.data.zip);
                }
            }
        });


    });

    $(league_name_field).on('blur', function () {
        const leagueNameInput = $(this).val();
        const isCustomText = !pre_approved_leagues.some(league =>
            league.league_name.toLowerCase() === leagueNameInput.toLowerCase()
        );

        if (isCustomText) {
            $(league_id_field).val('');
            $(league_id_field).prop('readonly', false);

            $(shipping_city_field).val('');
            $(shipping_state_field).val('').trigger('change');
            $(shipping_zip_field).val('');
        } else {
            $(league_id_field).prop('readonly', true);
        }
    });

    $('#event_type').change(function () {
        const eventType = $(this).val();

        // Reset rules for all fields first
        $('#baseball_event_name').rules('remove', 'required');
        $('#baseball_event_date_time, #baseball_no_of_participants').rules('remove', 'required integer');


        $('#softball_event_name, #softball_event_date_time, #softball_no_of_participants').rules('remove', 'required integer');

        updateEventSection(eventType);
    });

    function updateEventSection(eventType) {
        if (eventType === '1') {
            $('#baseball_event_section').show();
            $('#softball_event_section').hide();

            $('#baseball_event_name').rules('add', { required: true });
            $('#baseball_event_date_time').rules('add', { required: true });
            $('#baseball_no_of_participants').rules('add', { required: true, integer: true });
        } else if (eventType === '2') {
            $('#baseball_event_section').hide();
            $('#softball_event_section').show();

            $('#softball_event_name').rules('add', { required: true });
            $('#softball_event_date_time').rules('add', { required: true });
            $('#softball_no_of_participants').rules('add', { required: true, integer: true });
        } else if (eventType === '3') {
            $('#baseball_event_section').show();
            $('#softball_event_section').show();

            $('#baseball_event_name').rules('add', { required: true });
            $('#baseball_event_date_time').rules('add', { required: true });
            $('#baseball_no_of_participants').rules('add', { required: true, integer: true });

            $('#softball_event_name').rules('add', { required: true });
            $('#softball_event_date_time').rules('add', { required: true });
            $('#softball_no_of_participants').rules('add', { required: true, integer: true });
        }
    }

    // Login

    $('#login_form').validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please enter the username",
            },
            password: {
                required: "Please enter the password",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    // FedEx Address VValidation Start

    function doneTyping () {
        verify_address_from_fedex(street_address_field, city_field, state_field, zip_field);
    }

    $(street_address_field).on('keyup', function () {
        clearTimeout(typingTimer);
        if ($(street_address_field).val()) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });

    $(city_field).on('keyup', function () {
        clearTimeout(typingTimer);
        if ($(city_field).val()) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });

    $(state_field).on('change', function () {
        verify_address_from_fedex(street_address_field, city_field, state_field, zip_field);
    });

    $(zip_field).on('keyup', function () {
        clearTimeout(typingTimer);
        if ($(zip_field).val()) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });

    function verify_address_from_fedex(street_address_field, city_field, state_field, zip_field) {
        if ($(street_address_field).val() && $(city_field).val() && $(state_field).val() && $(zip_field).val()) {
            if ($.trim($(zip_field).val()).length > 4 && $.trim($(city_field).val()).length > 4 && $.trim($(street_address_field).val()).length > 10) {
                $.ajax({
                    method: "POST",
                    url: fedexAddressValidateUrl,
                    data: {
                        street_address: $(street_address_field).val(),
                        city: $(city_field).val(),
                        state: $(state_field).val(),
                        zip: $(zip_field).val()
                    },
                    success: function (response) {
                         $('.fedex_success_address').remove();
                         $('.fedex_error_address').remove();
                         $('input[name="verify_address"]').val('');
                         let html = '';
                         if(response.status == 'success') {

                             if(response.address_status == true) {
                                 $('input[name="verify_address"]').val('yes');
                                 html = '<div class="fedex_success_address"><p class="suggested_address">Standardized Address: Street Lines: ' + response.response_fedex.streetLinesToken[0] + ' - City: ' + response.response_fedex.city + ' - State: ' + response.response_fedex.stateOrProvinceCode + ' - Postal Code: ' + response.response_fedex.postalCode + '</p><button class="fedex-address-useit-button" type="button" onclick="useFedexStandardizedAddress(this)" data-street-address="' + response.response_fedex.streetLinesToken[0] + '" data-city="'+response.response_fedex.city+'" data-zip-code="'+response.response_fedex.postalCode+'">Use It</button></div>'
                             } else {
                                 if(response.fedex_standardized_address == false) {
                                     $('input[name="verify_address"]').val('no');
                                     html = '<div class="fedex_error_address"><p>' + response.message + '</p></div>'
                                 } else {
                                     $('input[name="verify_address"]').val('no');
                                     html = '<div class="fedex_error_address"><p>' + response.message + '</p><p class="suggested_address">Standardized Address: City: ' + response.response_fedex.city + ' - State: ' + response.response_fedex.stateOrProvinceCode + ' - Postal Code: ' + response.response_fedex.postalCode + '</p><button class="fedex-address-useit-button" type="button" onclick="useFedexStandardizedAddress(this)" data-street-address="' + response.response_fedex.streetLinesToken[0] + '" data-city="'+response.response_fedex.city+'" data-zip-code="'+response.response_fedex.postalCode+'">Use It</button></div>'
                                 }
                             }
                         } else {
                             $('input[name="verify_address"]').val('no');
                             $(document).Toasts('create', {
                                 class: 'bg-danger',
                                 title: 'Error',
                                 body: response.message,
                             });
                         }
                         $('#fedex_address_response').html(html);
                    },
                    error: function (xhr) { // if error occured
                        $('input[name="verify_address"]').val('no');
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Error',
                            body: xhr.responseText,
                        });
                        console.log('error', xhr)
                    }
                });
            }
        }
    }

    function useFedexStandardizedAddress(obj) {
        let street_address = $(obj).attr('data-street-address');
        let city = $(obj).attr('data-city');
        let zip_code = $(obj).attr('data-zip-code');

        //$(street_address_field).val(street_address);
        $(city_field).val(city);
        $(zip_field).val(zip_code);

        return false;
    }

    // FedEx Address Validation End

    window.useFedexStandardizedAddress = useFedexStandardizedAddress;
    window.verify_address_from_fedex = verify_address_from_fedex;
    window.doneTyping = doneTyping;
    window.updateEventSection = updateEventSection;

})(jQuery)
