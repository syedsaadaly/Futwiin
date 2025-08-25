@extends('admin.layouts.admin')

@section('title', 'Edit Home Banner')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white"
                 style="background-color: rgb(0, 0, 0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Edit Home Banner
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('cms.home-banner.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Title</label>
                        <input type="text" name="title"
                               value="{{ old('title', $content['title'] ?? '') }}"
                               class="form-control" placeholder="Enter banner title">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Highlight Text</label>
                        <input type="text" name="highlight"
                               value="{{ old('highlight', $content['highlight'] ?? '') }}"
                               class="form-control" placeholder="Enter highlight text">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Subtitle</label>
                        <textarea name="subtitle" rows="3"
                                  class="form-control"
                                  placeholder="Enter subtitle...">{{ old('subtitle', $content['subtitle'] ?? '') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Button 1 Text</label>
                            <input type="text" name="btn1_text"
                                   value="{{ old('btn1_text', $content['btn1_text'] ?? '') }}"
                                   class="form-control" placeholder="e.g. Join Now">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Button 1 Link</label>
                            <input type="text" name="btn1_link"
                                   value="{{ old('btn1_link', $content['btn1_link'] ?? '') }}"
                                   class="form-control" placeholder="https://...">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Button 2 Text</label>
                            <input type="text" name="btn2_text"
                                   value="{{ old('btn2_text', $content['btn2_text'] ?? '') }}"
                                   class="form-control" placeholder="e.g. Learn More">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Button 2 Link</label>
                            <input type="text" name="btn2_link"
                                   value="{{ old('btn2_link', $content['btn2_link'] ?? '') }}"
                                   class="form-control" placeholder="https://...">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Success Rate (%)</label>
                            <input type="number" name="success_rate"
                                   value="{{ old('success_rate', $content['success_rate'] ?? '') }}"
                                   class="form-control" placeholder="90">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Leagues Covered</label>
                            <input type="number" name="leagues"
                                   value="{{ old('leagues', $content['leagues'] ?? '') }}"
                                   class="form-control" placeholder="50">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Happy Members (in K)</label>
                            <input type="number" name="members"
                                   value="{{ old('members', $content['members'] ?? '') }}"
                                   class="form-control" placeholder="25">
                        </div>
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
