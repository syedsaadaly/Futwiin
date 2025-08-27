@extends('admin.layouts.admin')

@section('title', 'Edit Saying Section')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card card-primary shadow-sm" data-aos="fade-up" data-aos-duration="1000">

                <div class="card-header text-white" style="background-color: rgb(0,0,0);">
                    <h1 class="page-heading mb-0" style="font-size: 22px;">
                        Edit Saying Section
                    </h1>
                </div>

                <form action="{{ route('cms.saying.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label class="fw-bold">Section Title</label>
                            <input type="text" name="title" value="{{ old('title', $sayingCms->title ?? '') }}"
                                class="form-control" placeholder="Enter section title">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Section Subtitle</label>
                            <textarea name="subtitle" rows="4" class="form-control" placeholder="Enter section subtitle">{{ old('subtitle', $sayingCms->subtitle ?? '') }}</textarea>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-arrow-left me-1"></i> Cancel
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
