@extends('admin.layouts.admin')

@section('title', 'Edit Testimonials Page')

@section('content')
<div class="container-fluid">
    <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
        
        <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">
            <h1 style="font-size: 22px;" class="page-heading">Edit Testimonials Page</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif

        <div class="card-body">
            <form action="{{ route('admin.cms.testimonials.updatePage') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Page Title</label>
                    <input type="text" name="page_title" class="form-control" 
                           value="{{ $page->content['page_title'] ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Heading</label>
                    <input type="text" name="heading" class="form-control" 
                           value="{{ $page->content['heading'] ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Subheading</label>
                    <input type="text" name="subheading" class="form-control" 
                           value="{{ $page->content['subheading'] ?? '' }}">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.cms.testimonials.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-dark">Update Page</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
