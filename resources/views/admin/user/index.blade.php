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
                                            <button class="btn btn-danger btn-sm {{ auth()->id() != $user->id ? 'delete_user' : '' }}"
                                                data-user-id="{{ encrypt_decrypt('encrypt', $user->id) }}"
                                                title="{{ auth()->id() == $user->id ? 'This account is currently logged in, and therefore cannot be deleted.' : "Delete" }}">
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

    $(document).on('click', '.delete_user', function() {
        let user_id = $(this).attr('data-user-id');
        if (user_id) {
            if(confirm('Are you sure you want to delete this user?')) {
                let deleteUrl = "{{ route('admin.deleteUser', ['id' => '__USER_ID__']) }}".replace('__USER_ID__', user_id);
                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
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
