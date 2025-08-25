@extends('admin.layouts.admin')

@section('title', 'Add Featured Player')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card card-primary shadow-sm" data-aos="fade-up" data-aos-duration="1000">

            {{-- Header --}}
            <div class="card-header text-white" style="background-color: rgb(0,0,0);">
                <h1 class="page-heading mb-0" style="font-size: 22px;">
                    Add New Featured Player
                </h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.featured-players.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <div class="form-group mb-3">
                        <label class="fw-bold">Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Club</label>
                        <input type="text" name="club" value="{{ old('club') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Age</label>
                        <input type="number" name="age" value="{{ old('age') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Position</label>
                        <input type="text" name="position" value="{{ old('position') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Nationality</label>
                        <input type="text" name="nationality" value="{{ old('nationality') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Stats (e.g. 15 Goals, 8 Assists)</label>
                        <input type="text" name="stats" value="{{ old('stats') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Description</label>
                        <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Player Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-plus me-1"></i> Add Player
                    </button>
                    <a href="{{ route('admin.featured-players.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>

        </div>

    </div>
</div>
@endsection
