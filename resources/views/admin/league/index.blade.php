@extends('admin.layouts.admin')
@section('content')
    <style>
        .dataTables_length{
            margin-top: 10px;
            margin-left: 5px;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 style="font-size: 24px">
                            {{ $pageData->pageName ?? 'Leagues Management' }}
                        </h1>
                        <a href="{{ route('admin.leagues.create') }}">
                            <button class="btn btn-dark">+ Add League</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="leaguesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>League Date</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leagues as $league)
                                    <tr>
                                        <td>{{ $league->title ?? '-' }}</td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $league->type == 1 ? 'International' : 'Domestic' }}
                                            </span>
                                        </td>
                                        <td>{{ $league->league_date ? \Carbon\Carbon::parse($league->league_date)->format('m-d-Y') : '-' }}</td>                                        <td>
                                            @if($league->hasMedia('league_images'))
                                                <img src="{{ $league->getFirstMediaUrl('league_images') }}" width="50" height="50" class="img-thumbnail">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.leagues.edit', encrypt_decrypt('encrypt', $league->id)) }}"
                                               title="Edit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm delete_league"
                                                data-league-id="{{ encrypt_decrypt('encrypt', $league->id) }}"
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
    $('#leaguesTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        }
    });
    const CSRF_TOKEN = "{{ csrf_token() }}";
    $(document).on('click', '.delete_league', function() {
        let league_id = $(this).attr('data-league-id');
        if (league_id) {
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
                    let deleteUrl = "{{ route('admin.leagues.delete', ['id' => '__LEAGUE_ID__']) }}".replace('__LEAGUE_ID__', league_id);
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message || 'League has been deleted successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'An error occurred while deleting the league.';
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
