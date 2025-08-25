@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 22px" class="page-heading">
                        {{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}
                    </h1>
                </div>

                <div class="card-body">
                    <form method="POST" 
                          action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($testimonial))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="author">Author <span class="text-danger">*</span></label>
                            <input type="text" name="author" class="form-control"
                                   value="{{ old('author', $testimonial->author ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role/Position</label>
                            <input type="text" name="role" class="form-control"
                                   value="{{ old('role', $testimonial->role ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" rows="4" required>{{ old('message', $testimonial->message ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image (optional)</label>
                            <input type="file" name="image" class="form-control-file">
                            @if(isset($testimonial) && $testimonial->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" width="80" height="80" style="border-radius: 50%; object-fit: cover;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="status" id="status" value="1"
                                   class="form-check-input"
                                   {{ old('status', $testimonial->status ?? false) ? 'checked' : '' }}>
                            <label for="status" class="form-check-label">Active</label>
                        </div>

                        <button type="submit" class="btn btn-dark">
                            {{ isset($testimonial) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
