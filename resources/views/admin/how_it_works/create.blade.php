@extends('admin.layouts.admin')

@section('title', 'Add New How It Works Item')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card card-primary shadow-sm" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white" style="background-color: rgb(0,0,0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Add New How It Works Item
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.how-it-works.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Icon (Font Awesome class)</label>
                        <input type="text" name="icon" class="form-control"
                               placeholder="e.g. fas fa-search"
                               value="{{ old('icon') }}">
                        <small class="text-muted">Example: <code>fas fa-user</code></small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Title</label>
                        <input type="text" name="title" class="form-control"
                               placeholder="Enter title"
                               value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Enter description" required>{{ old('description') }}</textarea>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Add Item
                    </button>
                    <a href="{{ route('admin.how-it-works.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </form>

        </div>

    </div>
</div>
@endsection
