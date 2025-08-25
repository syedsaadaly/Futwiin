@extends('admin.layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

            <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">
                <h1 style="font-size: 22px;" class="page-heading">Edit Testimonial</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.cms.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name', $testimonial->name) }}">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $testimonial->designation) }}">
                        @error('designation') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea name="message" rows="4" class="form-control" required>{{ old('message', $testimonial->message) }}</textarea>
                        @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="mt-2">
                            <img src="{{ $testimonial->getImageUrl() }}" width="100" class="rounded shadow-sm">
                            <p class="text-muted mt-1">Current Image</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.cms.testimonials.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-dark">Update Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
