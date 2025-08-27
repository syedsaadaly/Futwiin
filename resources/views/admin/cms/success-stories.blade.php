@extends('admin.layouts.admin')

@section('title', 'Edit Success Stories')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

                <div class="card-header text-white" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 22px;" class="page-heading">Edit Success Stories</h1>
                </div>

                <form action="{{ route('cms.success-stories.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Section Title</label>
                            <input type="text" name="title" value="{{ old('title', $successStories->title ?? '') }}"
                                class="form-control">
                        </div>

                        <hr>
                        <h4 class="mb-3">Statistics Items</h4>

                        @foreach ($successStories->items ?? [] as $index => $item)
                            <div class="border rounded p-3 mb-3 bg-light">
                                <div class="mb-2">
                                    <label class="form-label">Value</label>
                                    <input type="text" name="items[{{ $index }}][value]"
                                        value="{{ old("items.$index.value", $item['value'] ?? '') }}" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">Line 1</label>
                                    <input type="text" name="items[{{ $index }}][line1]"
                                        value="{{ old("items.$index.line1", $item['line1'] ?? '') }}" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">Line 2</label>
                                    <input type="text" name="items[{{ $index }}][line2]"
                                        value="{{ old("items.$index.line2", $item['line2'] ?? '') }}" class="form-control">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
