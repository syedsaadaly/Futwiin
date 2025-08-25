@extends('admin.layouts.admin')

@section('title', 'Edit Pricing Page')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

            <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">
                <h1 style="font-size: 22px;" class="page-heading">Edit Pricing Page</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.cms.pricing.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Banner Title</label>
                        <input type="text" name="banner_title" class="form-control" 
                               value="{{ json_decode($page->content)->banner_title ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Main Heading</label>
                        <input type="text" name="main_heading" class="form-control" 
                               value="{{ json_decode($page->content)->main_heading ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Main Paragraph</label>
                        <textarea name="main_paragraph" rows="4" class="form-control" required>{{ json_decode($page->content)->main_paragraph ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" 
                               value="{{ $page->meta_title }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="form-control" required>{{ $page->meta_description }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
