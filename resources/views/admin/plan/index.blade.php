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
                            {{ $pageData->pageName ?? 'Plans Management' }}
                        </h1>
                        <a href="{{ route('admin.plans.create') }}">
                            <button class="btn btn-dark">+ Add Plan</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="plansTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Points</th>
                                        <th>Duration Offset</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->name ?? '-' }}</td>
                                        <td>${{ number_format($plan->price, 2) }}</td>
                                        <td>{{ $plan->points }}</td>
                                        <td>
                                            @if($plan->predicted_view_duration_offset < 60)
                                                {{ $plan->predicted_view_duration_offset }} mins
                                            @else
                                                {{ floor($plan->predicted_view_duration_offset / 60) }}h
                                                @if($plan->predicted_view_duration_offset % 60 != 0)
                                                    {{ $plan->predicted_view_duration_offset % 60 }}m
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($plan->text, 50) ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.plans.edit', encrypt($plan->uuid)) }}"
                                               title="Edit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm delete_plan"
                                                data-plan-id="{{ encrypt($plan->uuid) }}"
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
    $('#plansTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        }
    });

    const CSRF_TOKEN = "{{ csrf_token() }}";
    $(document).on('click', '.delete_plan', function() {
        let plan_id = $(this).attr('data-plan-id');
        if (plan_id) {
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
                    let deleteUrl = "{{ route('admin.plans.delete', ['id' => '__PLAN_ID__']) }}".replace('__PLAN_ID__', plan_id);
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message || 'Plan has been deleted successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'An error occurred while deleting the plan.';
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
