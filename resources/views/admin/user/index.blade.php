@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px">
                        {{ $pageData->pageName ?? '' }}
                    </h1>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="usersTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->first_name ?? '-' }}</td>
                                        <td>{{ $user->last_name ?? '-' }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ ucfirst(str_replace(['-', '_'], ' ', $user->getRoleNames()->first())) }}
                                            </span>
                                        </td>
                                        {{-- <td>
                                            <button class="btn btn-sm {{ auth()->id() != $user->id ? 'toggle-status' : '' }} badge badge-{{ $user->status == 1 ? 'success' : 'danger' }}"
                                                data-id="{{ $user->id }}"
                                                data-status="{{ $user->status }}"
                                                title="{{ auth()->id() == $user->id ? 'You cannot deactivate your own account.' : ($user->status ? 'Deactivate' : 'Activate') }}">
                                                {{ $user->status ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td> --}}
                                        <td>
                                            <button class="btn btn-danger btn-sm delete-user-btn"
                                                data-user-id="{{ $user->id }}"
                                                data-is-current="{{ auth()->id() == $user->id ? 'true' : 'false' }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </dkiv>
        </div>
    </div>
@endsection

@section('common_script')
<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        }
    });

    $(document).on('click', '.edit_user', function() {
        let user_id = $(this).attr('data-user-id');
        if (user_id) {
            let getUserUrl = "{{ route('admin.getUser', ['id' => '__USER_ID__']) }}".replace('__USER_ID__', user_id);
            $.ajax({
                url: getUserUrl,
                method: 'GET',
                success: function(response) {
                    if (response.html) {
                        $('#edit_user_content').html(response.html);
                        $('#edit_user_modal').modal('show');

                        $('#edit_user_form').on('submit', function(e) {
                            e.preventDefault();
                            let formData = $(this).serialize();

                            $.ajax({
                                url: $(this).attr('action'),
                                method: 'POST',
                                data: formData,
                                success: function(response) {
                                    $('#edit_user_modal').modal('hide');
                                    location.reload();
                                },
                                error: function(xhr) {

                                }
                            });
                        });
                    }
                }
            });
        }
    });

    $(document).on('click', '.delete-user-btn', function() {
        const userId = $(this).data('user-id');
        const isCurrentUser = $(this).data('is-current') == true;
        
        if (isCurrentUser) {
            Swal.fire({
                icon: 'error',
                title: 'Cannot Delete Account',
                text: 'You cannot delete your own account while logged in.',
                confirmButtonColor: '#d33',
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteUrl = "{{ route('admin.deleteUser', ['id' => '__USER_ID__']) }}".replace('__USER_ID__', userId);

                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Failed to delete user.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    $('#create_user_form').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#create_user_modal').modal('hide');
                location.reload();
            },
            error: function(xhr) {

            }
        });
    });
});
</script>
@endsection
