(function ($) {
    'use strict'

    $('#baseballeventdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

    $('#softballeventdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

    $('#addplayerdateofbirth').datetimepicker({format: 'L'});

    $('#editplayerdateofbirth').datetimepicker({format: 'L'});

    $('#event_type').change(function () {
        const eventType = $(this).val();
        updateEventSection(eventType);
    });

    function updateEventSection(eventType) {
        if (eventType === '1') {
            $('#baseball_event_section').show();
            $('#softball_event_section').hide();
        } else if (eventType === '2') {
            $('#baseball_event_section').hide();
            $('#softball_event_section').show();
        } else if (eventType === '3') {
            $('#baseball_event_section').show();
            $('#softball_event_section').show();
        }
    }

    function appAlert(type, message) {
        switch (type) {
            case 'success':
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Success',
                    body: message,
                });
                break;
            case 'error':
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    body: message,
                });
                break;
            default:
                $(document).Toasts('create', {
                    class: 'bg-info',
                    title: 'Info',
                    body: message,
                });
        }
    }

    $('#update_event_details_form').on('submit', function (e) {
        e.preventDefault();

        let existingLeagueEvent = $(this).find('[name="existing_league_event"]').val();
        let tobeUpdateLeagueEvent = $(this).find('[name="event_type"]').val();

        let updateEventUrl = $(this).attr('action');
        let formData = $(this).serialize();


        if ((existingLeagueEvent == 3 && (tobeUpdateLeagueEvent == 1 || tobeUpdateLeagueEvent == 2))) {
            $('#change_event_type_warning').modal('show');

            $('#confirm_update_league_event').off('click').on('click', function () {
                updateEventDetails(updateEventUrl, formData);
            });

        } else if (existingLeagueEvent == 1 || existingLeagueEvent == 2) {
            if (tobeUpdateLeagueEvent != 3 && tobeUpdateLeagueEvent != existingLeagueEvent) {

                $('#change_event_type_warning').modal('show');

                $('#confirm_update_league_event').off('click').on('click', function () {
                    updateEventDetails(updateEventUrl, formData);
                });

            } else {
                updateEventDetails(updateEventUrl, formData);
            }
        } else {
            updateEventDetails(updateEventUrl, formData);
        }
    });

    function updateEventDetails(updateEventUrl, formData) {
        $.ajax({
            url: updateEventUrl,
            method: 'POST',
            data: formData,
            success: function (response) {
                appAlert('success', response.message);
                $('#change_event_type_warning').modal('hide');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors).map(error => error[0]).join('<br/>');
                    appAlert('error', errorMessages);
                    $('#change_event_type_warning').modal('hide');
                } else {
                    appAlert('error', xhr.responseJSON.message);
                    $('#change_event_type_warning').modal('hide');
                }
            }
        });
    }

    $('[data-mask]').inputmask();

    $('#update_contact_information_form').validate({
        rules: {
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
            }
        },
        messages: {
            email: {
                required: "Please enter a email address",
                email: "Please enter a valid email address"
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

    $('#add_player_form').validate({
        rules: {
            player_event_type: {
                required: true,
                integer: true
            },
            player_full_name: {
                required: true,
            },
            player_dob: {
                required: true,
            },
            player_no_of_hr: {
                required: true,
            },
            player_parent_name: {
                required: true,
            },
            player_parent_phone: {
                required: true,
            },
            player_parent_email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Please enter a email address",
                email: "Please enter a valid email address"
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

    window.appAlert = appAlert;
    window.updateEventSection = updateEventSection;
    window.updateEventDetails = updateEventDetails;

})(jQuery)
