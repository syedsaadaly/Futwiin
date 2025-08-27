@extends('admin.layouts.admin')

@section('title', 'Manage Testimonials')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

                {{-- Header --}}
                <div class="card-header text-white d-flex justify-content-between align-items-center"
                    style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px;" class="page-heading">Manage Testimonials</h1>
                    <div>
                        <a href="{{ route('admin.cms.testimonials.create') }}" class="btn btn-dark">+ Add Testimonial</a>
                        <a href="{{ route('admin.cms.testimonials.editPage') }}" class="btn btn-secondary">Edit Page
                            Content</a>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body table-responsive">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Message</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonials as $key => $testimonial)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ $testimonial->getImageUrl() }}" width="60" height="60"
                                            class="rounded-circle border">
                                    </td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->designation }}</td>
                                    <td>{{ Str::limit($testimonial->message, 50) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.cms.testimonials.edit', $testimonial->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('admin.cms.testimonials.destroy', $testimonial->id) }}"
                                            method="POST" style="display:inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No Testimonials Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $testimonials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
