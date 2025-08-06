@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 style="font-size: 24px" class="page-heading">
                            {{ $pageData->pageName ?? 'Teams Management' }}
                        </h1>
                        <a href="{{ route('admin.teams.create') }}">
                            <button class="btn btn-dark">+ Add Team</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="teamsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $team)
                                    <tr>
                                        <td>{{ $team->name ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.teams.edit', $team->id) }}"
                                               title="Edit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm delete_team"
                                                data-team-id="{{ $team->id }}"
                                                title="Delete">
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
            </div>
        </div>
    </div>
@endsection

@section('common_script')
<script>
$(document).ready(function() {
    $('#teamsTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        }
    });

    const CSRF_TOKEN = "{{ csrf_token() }}";
    $(document).on('click', '.delete_team', function() {
        let team_id = $(this).attr('data-team-id');
        if (team_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let deleteUrl = "{{ route('admin.teams.delete', ['id' => '__TEAM_ID__']) }}".replace('__TEAM_ID__', team_id);
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message || 'Team has been deleted successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'An error occurred while deleting the team.';
                            Swal.fire(
                                'Error!',
                                errorMessage,
                                'error'
                            );
                        }
                    });
                }
            });
        }
    });
});
</script>
@endsection
