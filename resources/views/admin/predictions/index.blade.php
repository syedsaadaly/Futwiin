@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 style="font-size: 24px" class="page-heading">
                            {{ $pageData->pageName ?? 'Predictions Management' }}
                        </h1>
                        <a href="{{ route('admin.predictions.create') }}">
                            <button class="btn btn-dark">+ Add Prediction</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="predictionsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Teams</th>
                                        <th>Title</th>
                                        <th>Match Date/Time</th>
                                        <th>Image</th>
                                        <th>Teaser</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($predictions as $prediction)
                                    <tr>
                                        <td>
                                            {{ $prediction->team1->name }} vs {{ $prediction->team2->name }}
                                        </td>
                                        <td>{{ $prediction->title }}</td>
                                        <td>
                                            {{ $prediction->match_date->format('d M Y') }}<br>
                                            {{ $prediction->match_time }}
                                        </td>
                                        <td>
                                            @if($prediction->hasMedia('prediction_images'))
                                                <img src="{{ $prediction->getFirstMediaUrl('prediction_images') }}" width="50" class="img-thumbnail">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($prediction->is_teaser)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.predictions.edit', encrypt($prediction->uuid)) }}"
                                               title="Edit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm delete_prediction"
                                                data-prediction-id="{{ encrypt($prediction->uuid) }}"
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
    $('#predictionsTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        },
        order: [[2, 'desc']] // Sort by match date by default
    });

    const CSRF_TOKEN = "{{ csrf_token() }}";
    $(document).on('click', '.delete_prediction', function() {
        let prediction_id = $(this).attr('data-prediction-id');
        if (prediction_id) {
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
                    let deleteUrl = "{{ route('admin.predictions.delete', ['id' => '__PREDICTION_ID__']) }}".replace('__PREDICTION_ID__', prediction_id);
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message || 'Prediction has been deleted successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'An error occurred while deleting the prediction.';
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
