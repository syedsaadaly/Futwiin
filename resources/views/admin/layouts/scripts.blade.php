<script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('admin_assets/js/select2.full.js') }}"></script>
<script src="{{ asset('admin_assets/js/moment.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin_assets/js/tempusdominus-bootstrap-4.js') }}"></script>
<script src="{{ asset('admin_assets/js/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/waitMe/waitMe.js') }}"></script>
<script src="{{ asset('admin_assets/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/adminlte.js') }}"></script>
<script src="{{ asset('admin_assets/js/summernote/summernote-bs4.min.js') }}"></script>
{{-- <script src="{{ asset('admin_assets/assets/plugins/dropzone/dropzone.js') }}"></script> --}}
<script src="{{ asset('admin_assets/js/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/dropzone/dropzone.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script> --}}
<!-- DataTables & Buttons JS -->
<script src="{{ asset('admin_assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/vfs_fonts.js') }}"></script>
<script src="https://js.braintreegateway.com/web/dropin/1.45.0/js/dropin.min.js"></script>
{{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function() {
  var activeLink = $('.nav-link.active');
  if (activeLink.length > 0) {
    var sidebar = $('.sidebar');
    var offset = activeLink.offset().top - sidebar.offset().top + sidebar.scrollTop();
    sidebar.animate({
      scrollTop: offset - 100 // adjust the offset to your liking
    }, 500);
  }
});



</script>

<script>
$(document).ready(function() {
    $('.sidebar-scroll-to-top').on('click', function() {
        console.log('sidebar clicked - scrolling to bottom');
        $('.sidebar').animate({
            scrollTop: $('.sidebar')[0].scrollHeight
        }, 500);
    });
});
</script>
<script>
 AOS.init();
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        beforeSend: function(xhr) {
            $('body').waitMe({
                effect: 'ios'
            });
        },
        complete: function() {
            $('body').waitMe('hide');
        },
        statusCode: {
            401: function() {
                setTimeout(function() {
                    window.location.href = "{{ route('logout') }}";
                }, 2000);
            },
            500: function() {
                Swal.fire({
                    title: "Validation Error",
                    text: "Something went wrong!",
                    icon: "error",
                    showConfirmButton: false,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    timer: 5000,
                    customClass: {
                        popup: 'swal-custom-border'
                    }
                });
            }
        }
    });

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            Swal.fire({
                title: "Error",
                text: "{{ $error }}",
                icon: "error",
                showConfirmButton: false,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                timer: 5000,
                customClass: {
                    popup: 'swal-custom-border'
                }
            });
        @endforeach
    @endif

    @if (session('success'))
        Swal.fire({
            title: "Success",
            text: "{{ session('success') }}",
            icon: "success",
            showConfirmButton: false,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            timer: 5000,
            customClass: {
                popup: 'swal-custom-border'
            }
        });
    @endif

    @if (session('error'))
        Swal.fire({
            title: "Error",
            text: "{{ session('error') }}",
            icon: "error",
            showConfirmButton: false,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            timer: 5000,
            customClass: {
                popup: 'swal-custom-border'
            }
        });
    @endif

    $(function() {
        if ($('[data-toggle="popover"]').length > 0) {
            $('[data-toggle="popover"]').popover({
                container: 'body'
            });
        }

        $(document).on('mouseenter', '[data-toggle="tooltip"]', function () {
            const $this = $(this);

            if (!$this.data('bs.tooltip')) {
                $this.tooltip();
                $this.tooltip('show');
            }
        });
    });

    let serverDateTime = new Date("{{ now()->timezone(config('app.timezone'))->format('Y-m-d H:i:s') }}");
    let timeZone = "EST";

    function updateTime() {
        serverDateTime.setMinutes(serverDateTime.getMinutes() + 1);
        let timeString = serverDateTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        document.getElementById("currentTime").innerText = timeString + " (" + timeZone + ")";
    }

    setInterval(updateTime, 59000);

    updateTime();

</script>

{{-- @if (auth()->user()->hasPermissionTo('basic-dashboard') || auth()->user()->hasPermissionTo('vip-dashboard'))
    <script src="{{ asset('admin_assets/js/customer-template.js') }}"></script>
@endif --}}
<script src="{{ asset('admin_assets/js/admin-template.js') }}"></script>
<script src="{{ asset('admin_assets/js/template.js') }}"></script>
@yield('common_script')
@stack('scripts')
