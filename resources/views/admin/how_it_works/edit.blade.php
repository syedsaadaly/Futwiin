@extends('admin.layouts.admin')

@section('title', 'Edit How It Works Item')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card card-primary shadow-sm" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white"
                 style="background-color: rgb(0,0,0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Edit How It Works Item
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.how-it-works.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Icon (Font Awesome Class)</label>
                        <input type="text" name="icon"
                               class="form-control"
                               value="{{ old('icon', $item->icon) }}"
                               placeholder="e.g. fas fa-user">
                        <small class="text-muted">Example: <code>fas fa-star</code></small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Title</label>
                        <input type="text" name="title"
                               class="form-control"
                               value="{{ old('title', $item->title) }}"
                               placeholder="Enter title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Description</label>
                        <textarea name="description" rows="4"
                                  class="form-control"
                                  placeholder="Enter description..." required>{{ old('description', $item->description) }}</textarea>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-1"></i> Update Item
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
