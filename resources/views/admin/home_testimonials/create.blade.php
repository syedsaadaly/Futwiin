@extends('admin.layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-header text-white pb-0" style="background-color: rgb(0,0,0);">
                <h1 style="font-size: 24px" class="page-heading">Add Testimonial</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="author">Author Name</label>
                        <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                            value="{{ old('author') }}" required>
                        @error('author') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role/Designation</label>
                        <input type="text" name="role" class="form-control @error('role') is-invalid @enderror"
                            value="{{ old('role') }}">
                        @error('role') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                        @error('message') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image (optional)</label>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                        @error('image') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                            value="{{ old('sort_order') }}">
                        @error('sort_order') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input" {{ old('status') ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-dark">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
