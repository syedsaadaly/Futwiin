(function ($) {
    'use strict'

    $('[data-mask]').inputmask();

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
            case 'warning':
                $(document).Toasts('create', {
                    class: 'bg-warning',
                    title: 'Warning',
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

    $('#leagueAdminPlayersTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    $(document).ready(function () {
        let $table = $('#allUsersTable1');
        let disableSearch = $table.data('search') == "false";
        let table = $('#allUsersTable1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": disableSearch,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            dom: 'Bfrtip', // Enables buttons
            buttons: [
                {
                    extend: 'excel',
                    text: 'Export to Excel', // Button text
                    className: 'btn btn-primary', // Bootstrap styling
                    exportOptions: {
                        columns: ':visible' // Export only visible columns
                    }
                }
            ],
            columnDefs: [
                { orderable: false, targets: -1 } // Disables sorting on the last column (Actions)
            ],
            "initComplete": function () {
                // Add placeholder to the search box
                $('#allUsersTable1_filter input').attr('placeholder', $('#allUsersTable1').attr('data-placeholder'));
            },
            "drawCallback": function (settings) {
                // checkRecordCount();
            }
        });
        $('#exportExcel').on('click', function () {
            table.button('.buttons-excel').trigger();
        });
        // checkRecordCount();

        // Attach the buttons to the DataTable
        table.buttons().container().appendTo('#allUsersTable1_wrapper .col-md-6:eq(0)');

        // function checkRecordCount() {
        //     let recordCount = $('#allUsersTable1 tbody tr').length;
        //     if (recordCount < 10) {
        //         $('#allUsersTable1_filter').hide();
        //         $('#exportExcel').hide();
        //     } else {
        //         $('#allUsersTable1_filter').show();
        //         $('#exportExcel').show();
        //     }
        // }

    });
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toltip="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });


    // Middleware Settings table
    let syncLogsTable = $('#syncLogsTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
        dom: 'Bfrtip', // Enables buttons
        buttons: [
            {
                extend: 'excel',
                text: 'Export to Excel', // Button text
                className: 'btn btn-primary', // Bootstrap styling
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            }
        ],
        columnDefs: [
            { orderable: false, targets: -1 } // Disables sorting on the last column (Actions)
        ],
        "initComplete": function () {
            // Add placeholder to the search box
            $('#syncLogsTable_filter input').attr('placeholder', $('#syncLogsTable').attr('data-placeholder'));
        },
        "drawCallback": function (settings) {
            // checkRecordCount();
        }
    });

    let syncQueueTable = $('#syncQueueTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
        dom: 'Bfrtip', // Enables buttons
        buttons: [
            {
                extend: 'excel',
                text: 'Export to Excel', // Button text
                className: 'btn btn-primary', // Bootstrap styling
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            }
        ],
        columnDefs: [
            { orderable: false, targets: -1 } // Disables sorting on the last column (Actions)
        ],
        "initComplete": function () {
            // Add placeholder to the search box
            $('#syncQueueTable_filter input').attr('placeholder', $('#syncQueueTable').attr('data-placeholder'));
        },
        "drawCallback": function (settings) {
            // checkRecordCount();
        }
    });
    let syncConfigTable = $('#syncConfigTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
        dom: 'Bfrtip', // Enables buttons
        buttons: [
            {
                extend: 'excel',
                text: 'Export to Excel', // Button text
                className: 'btn btn-primary', // Bootstrap styling
                exportOptions: {
                    columns: ':visible' // Export only visible columns
                }
            }
        ],
        columnDefs: [
            { orderable: false, targets: -1 } // Disables sorting on the last column (Actions)
        ],
        "initComplete": function () {
            // Add placeholder to the search box
            $('#syncConfigTable_filter input').attr('placeholder', $('#syncConfigTable').attr('data-placeholder'));
        },
        "drawCallback": function (settings) {
            // checkRecordCount();
        }
    });



    window.appAlert = appAlert;

})(jQuery)

$(document).on('click', '.toggle-status', function () {
    let button = $(this);
    let itemId = button.data('id');
    let currentStatus = button.data('status');
    let updateUrl = button.data('url');
    let isCustomer = button.data('customer') === true || button.data('customer') === 'true';

    let extraNote = isCustomer
        ? `<br>Note - Deactivating the status will prevent the user from logging in to the store. This would not delete any user data from the system or Salesforce.`
        : "";

    Swal.fire({
        title: 'Are you sure?',
        html: `You are about to change the status.${extraNote}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: updateUrl,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: itemId,
                    status: currentStatus
                },
                success: function (response) {
                    if (response.success) {
                        let newStatus = response.status;
                        button.data('status', newStatus)
                            .removeClass('badge-success badge-danger')
                            .addClass(newStatus == 1 ? 'badge-success' : 'badge-danger')
                            .text(newStatus == 1 ? 'Active' : 'Inactive');

                        Swal.fire(
                            'Updated!',
                            'Status has been changed.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error!',
                            'Something went wrong!',
                            'error'
                        );
                    }
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Server error occurred!',
                        'error'
                    );
                }
            });
        }
    });
});

$(document).ready(function () {
    $(document).on('change', '.select-all', function () {
        let table = $(this).closest('table');
        table.find('.checkbox-item').prop('checked', $(this).prop('checked'));
        toggleBulkDeleteButton();
    });

    $(document).on('change', '.checkbox-item', function () {
        toggleBulkDeleteButton();
    });

    function toggleBulkDeleteButton() {
        let checkedCount = $('.checkbox-item:checked').length;
        $('.bulk-delete').prop('disabled', checkedCount === 0);
    }

    $(document).on('click', '.bulk-delete', function () {
        let deleteUrl = $(this).data('url');
        let selectedIds = [];

        $('.checkbox-item:checked').each(function () {
            selectedIds.push($(this).data('id'));
        });

        if (selectedIds.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Selection!',
                text: 'Please select at least one item to delete.',
            });
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        ids: selectedIds
                    },
                    success: function (response) {
                        if (response.success) {
                            selectedIds.forEach(function (id) {
                                $('.checkbox-item[data-id="' + id + '"]').closest('tr').remove();
                            });

                            $('.select-all').prop('checked', false);
                            $('.checkbox-item').prop('checked', false);
                            $('.bulk-delete').prop('disabled', true);

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Selected items have been deleted successfully.',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong while deleting items.',
                            });
                        }
                    }
                });
            }
        });
    });
});
