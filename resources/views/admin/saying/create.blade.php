@extends('admin.layouts.admin')

@section('title', 'Add New Saying')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
            
            <!-- Header -->
            <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                <h1 style="font-size: 24px" class="page-heading">Add New Saying</h1>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.saying.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Designation</label>
                        <input type="text" name="designation" value="{{ old('designation') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Rating (1-5)</label>
                        <input type="number" name="rating" value="{{ old('rating', 5) }}" min="1" max="5" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Message</label>
                        <textarea name="message" rows="4" class="form-control" required>{{ old('message') }}</textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                    <a href="{{ route('admin.saying.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
