@extends('admin.layouts.admin')

@section('title', 'Edit Site Settings')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

                {{-- Header --}}
                <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">
                    <h1 class="page-heading mb-0" style="font-size: 22px;">
                        Edit Site Settings
                    </h1>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label class="fw-bold">Header Logo</label><br>
                            <input type="file" name="header_logo" class="form-control">
                            @if ($settingsPage->getFirstMediaUrl('header_logo'))
                                <img src="{{ $settingsPage->getFirstMediaUrl('header_logo') }}" width="100"
                                    class="mt-2">
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Fav Icon</label><br>
                            <input type="file" name="fav_icon" class="form-control">
                            @if ($settingsPage->getFirstMediaUrl('fav_icon'))
                                <img src="{{ $settingsPage->getFirstMediaUrl('fav_icon') }}" width="50" class="mt-2">
                            @endif
                        </div>

                        <hr>
                        <h4 class="fw-bold">Section Content</h4>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Heading</label>
                            <input type="text" name="section_heading" class="form-control"
                                value="{{ $settings['section_heading'] ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Paragraph</label>
                            <textarea name="section_paragraph" class="form-control">{{ $settings['section_paragraph'] ?? '' }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Button 1 Text</label>
                            <input type="text" name="section_btn_1_text" class="form-control"
                                value="{{ $settings['section_btn_1_text'] ?? '' }}">
                            <label class="fw-bold mt-2">Button 1 Link</label>
                            <input type="text" name="section_btn_1_link" class="form-control"
                                value="{{ $settings['section_btn_1_link'] ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Button 2 Text</label>
                            <input type="text" name="section_btn_2_text" class="form-control"
                                value="{{ $settings['section_btn_2_text'] ?? '' }}">
                            <label class="fw-bold mt-2">Button 2 Link</label>
                            <input type="text" name="section_btn_2_link" class="form-control"
                                value="{{ $settings['section_btn_2_link'] ?? '' }}">
                        </div>

                        <hr>
                        <h4 class="fw-bold">Footer</h4>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Footer Logo Text</label>
                            <input type="text" name="footer_logo_text" class="form-control"
                                value="{{ $settings['footer_logo_text'] ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Footer Paragraph</label>
                            <textarea name="footer_paragraph" class="form-control">{{ $settings['footer_paragraph'] ?? '' }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Facebook</label>
                            <input type="text" name="facebook_link" class="form-control"
                                value="{{ $settings['facebook_link'] ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Twitter</label>
                            <input type="text" name="twitter_link" class="form-control"
                                value="{{ $settings['twitter_link'] ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Instagram</label>
                            <input type="text" name="instagram_link" class="form-control"
                                value="{{ $settings['instagram_link'] ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">YouTube</label>
                            <input type="text" name="youtube_link" class="form-control"
                                value="{{ $settings['youtube_link'] ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Disclaimer</label>
                            <textarea name="footer_disclaimer" class="form-control">{{ $settings['footer_disclaimer'] ?? '' }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold">Copyright</label>
                            <input type="text" name="footer_copyright" class="form-control"
                                value="{{ $settings['footer_copyright'] ?? '' }}">
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save me-1"></i> Update Settings
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
