{{-- resources/views/admin/cms/leagues/edit.blade.php --}}
@extends('admin.layouts.admin')

@section('title', 'Edit Leagues Page')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px" class="page-heading">
                        Edit Leagues Page Content
                    </h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.cms.leagues.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Banner Title</label>
                                    <input type="text" name="banner_title" class="form-control"
                                        value="{{ json_decode($page->content)->banner_title ?? '' }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control"
                                        value="{{ $page->meta_title }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="2" required>{{ $page->meta_description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
