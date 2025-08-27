@extends('admin.layouts.admin')

@section('title', 'Add New Testimonial')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

                {{-- Header --}}
                <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 22px;" class="page-heading">Add New Testimonial</h1>
                </div>

                {{-- Body --}}
                <div class="card-body">
                    <form action="{{ route('admin.cms.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <input type="text" name="designation" class="form-control" value="{{ old('designation') }}">
                            @error('designation')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.cms.testimonials.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-dark">Save Testimonial</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
