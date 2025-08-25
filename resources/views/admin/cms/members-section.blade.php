@extends('admin.layouts.admin')

@section('title', 'Edit Members Section')

@section('content')
<div class="row">
    <div class="col-12">

        {{-- Members Section --}}
        <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white" style="background-color: rgb(0,0,0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Members Section
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('cms.members-section.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Title</label>
                        <input type="text" name="title"
                               value="{{ $members->title ?? '' }}"
                               class="form-control" placeholder="Enter section title">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Image</label>
                        <input type="file" name="image" class="form-control">

                        @if(isset($members->image) && $members->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$members->image) }}"
                                     alt="Members Image" width="150" class="rounded shadow-sm">
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-1"></i> Update Section
                    </button>
                </div>
            </form>
        </div>

        {{-- Member Points --}}
        <div class="card card-primary mt-4" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white" style="background-color: rgb(0,0,0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Member Points
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('cms.members-section.storePoint') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Point Heading</label>
                        <input type="text" name="heading" class="form-control" placeholder="Enter point heading">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Point Text</label>
                        <input type="text" name="text" class="form-control" placeholder="Enter point text">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Point Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Add Point
                    </button>
                </div>
            </form>

            {{-- Points List --}}
            <div class="card-body">
                <ul class="list-group">
                    @forelse($points as $point)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $point->heading }}</strong><br>
                                {{ $point->text }}
                            </div>
                            <form action="{{ route('cms.members-section.destroyPoint', $point->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No points added yet.</li>
                    @endforelse
                </ul>
            </div>

        </div>

    </div>
</div>
@endsection
