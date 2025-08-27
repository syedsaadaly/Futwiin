{{-- resources/views/admin/cms/expert-picks/edit.blade.php --}}
@extends('admin.layouts.admin')

@section('title', 'Edit Expert Picks Page')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px" class="page-heading">
                        Edit Expert Picks Page
                    </h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.cms.expert-picks.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Banner Title</label>
                            <input type="text" name="banner_title" class="form-control"
                                value="{{ json_decode($page->content)->banner_title ?? 'Expert Picks' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Heading</label>
                            <input type="text" name="main_heading" class="form-control"
                                value="{{ json_decode($page->content)->main_heading ?? 'Today\'s Featured Picks' }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Paragraph</label>
                            <textarea name="main_paragraph" rows="4" class="form-control" required>{{ json_decode($page->content)->main_paragraph ?? 'Preview our expert predictions for today\'s matches...' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ $page->meta_title }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" rows="2" class="form-control" required>{{ $page->meta_description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-dark">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
