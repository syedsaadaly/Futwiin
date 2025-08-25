{{-- resources/views/admin/players/index.blade.php --}}
@extends('admin.layouts.admin')

@section('title', 'Featured Players')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 style="font-size: 24px" class="page-heading">
                        Featured Players
                    </h1>
                    <a href="{{ route('admin.featured-players.create') }}">
                        <button class="btn btn-dark">+ Add Player</button>
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <table id="playersTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Club</th>
                                    <th>Position</th>
                                    <th>Nationality</th>
                                    <th>Stats</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($players as $player)
                                    <tr>
                                        <td>
                                            @if($player->image)
                                                <img src="{{ asset('storage/'.$player->image) }}" alt="{{ $player->name }}" width="70" class="rounded">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $player->name ?? '-' }}</td>
                                        <td>{{ $player->age ?? '-' }}</td>
                                        <td>{{ $player->club ?? '-' }}</td>
                                        <td>{{ $player->position ?? '-' }}</td>
                                        <td>{{ $player->nationality ?? '-' }}</td>
                                        <td>{{ $player->stats ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.featured-players.edit', $player->id) }}"
                                               title="Edit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm delete_player"
                                                data-player-id="{{ $player->id }}"
                                                title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No players added yet.</td>
                                    </tr>
                                @endforelse
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
    $('#playersTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        }
    });

    const CSRF_TOKEN = "{{ csrf_token() }}";
    $(document).on('click', '.delete_player', function() {
        let player_id = $(this).attr('data-player-id');
        if (player_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This player will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let deleteUrl = "{{ route('admin.featured-players.destroy', ['player' => '__PLAYER_ID__']) }}".replace('__PLAYER_ID__', player_id);
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message || 'Player has been deleted successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'An error occurred while deleting the player.';
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
