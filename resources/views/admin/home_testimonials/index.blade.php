@extends('admin.layouts.admin')
@section('content')
    <style>
        .dataTables_length {
            margin-top: 10px;
            margin-left: 5px;
        }
        .testimonial-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 style="font-size: 24px" class="page-heading">
                            {{ $pageData->pageName ?? 'Testimonials Management' }}
                        </h1>
                        <a href="{{ route('admin.hometestimonials.create') }}">
                            <button class="btn btn-dark">+ Add Testimonial</button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="testimonialsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Author</th>
                                        <th>Role</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Sort Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testimonials as $testimonial)
                                    <tr>
                                        <td>
                                            @if($testimonial->image)
                                                <img src="{{ asset('storage/' . $testimonial->image) }}" class="testimonial-img">
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>{{ $testimonial->author ?? '-' }}</td>
                                        <td>{{ $testimonial->role ?? '-' }}</td>
                                        <td>{{ Str::limit($testimonial->message, 50) }}</td>
                                        <td>
                                            <span class="badge {{ $testimonial->status ? 'badge-success' : 'badge-secondary' }}">
                                                {{ $testimonial->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $testimonial->sort_order ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                               title="Edit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm delete_testimonial"
                                                data-id="{{ $testimonial->id }}"
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
    $('#testimonialsTable').DataTable({
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        }
    });

    const CSRF_TOKEN = "{{ csrf_token() }}";

    $(document).on('click', '.delete_testimonial', function() {
        let id = $(this).attr('data-id');
        if (id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This testimonial will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let deleteUrl = "{{ route('admin.testimonials.destroy', ['testimonial' => '__ID__']) }}".replace('__ID__', id);
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message || 'Testimonial deleted successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = xhr.responseJSON?.message || 'Error while deleting testimonial.';
                            Swal.fire('Error!', errorMessage, 'error');
                        }
                    });
                }
            });
        }
    });
});
</script>
@endsection
