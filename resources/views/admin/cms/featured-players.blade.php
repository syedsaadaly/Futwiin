@extends('admin.layouts.admin')

@section('content')
<div class="card">
    <div class="card-header bg-dark text-black">
        <h3>Edit Featured Players</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('cms.featured-players.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $players->title ?? '' }}">
            </div>

            <div class="form-group">
                <label>Subtitle</label>
                <textarea name="subtitle" class="form-control">{{ $players->subtitle ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label>Footer Text</label>
                <textarea name="footer_text" class="form-control">{{ $players->footer_text ?? 'Our expert analysts track these players\' performances to deliver winning predictions' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
</div>
@endsection
