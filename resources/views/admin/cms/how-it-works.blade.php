@extends('admin.layouts.admin')

@section('title', 'Edit How It Works')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white"
                 style="background-color: rgb(0, 0, 0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Edit How It Works Section
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('cms.how-it-works.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Title</label>
                        <input type="text" name="title"
                               value="{{ old('title', $howItWorks->title ?? '') }}"
                               class="form-control"
                               placeholder="Enter section title">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Subtitle</label>
                        <textarea name="subtitle" rows="3"
                                  class="form-control"
                                  placeholder="Enter section subtitle">{{ old('subtitle', $howItWorks->subtitle ?? '') }}</textarea>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
