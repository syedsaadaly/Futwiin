@extends('admin.layouts.admin')

@section('title', 'Add New Tweet')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card card-primary shadow-sm" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white" style="background-color: rgb(0,0,0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Add New Tweet
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.twitter-items.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Username</label>
                        <input type="text" name="username" class="form-control"
                               value="{{ old('username') }}" placeholder="Enter name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Handle</label>
                        <input type="text" name="handle" class="form-control"
                               value="{{ old('handle') }}" placeholder="@handle" required>
                        <small class="text-muted">Example: <code>@yourhandle</code></small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Content</label>
                        <textarea name="content" rows="4" class="form-control"
                                  placeholder="Enter tweet content..." required>{{ old('content') }}</textarea>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                    <a href="{{ route('admin.twitter-items.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>

        </div>

    </div>
</div>
@endsection
