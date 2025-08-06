@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px" class="page-heading">
                        {{ $pageData->pageName ?? 'Edit League' }}
                    </h1>
                </div>
                <div class="card-body">
                    <form name="edit_league_form" id="edit_league_form" method="post"
                          action="{{ route('admin.leagues.update', $league->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title*</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{ $league->title }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label">Type*</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="1" {{ $league->type == 1 ? 'selected' : '' }}>International</option>
                                        <option value="2" {{ $league->type == 2 ? 'selected' : '' }}>Domestic</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="league_date" class="form-label">League Date</label>
                                    <input type="date" class="form-control" id="league_date" name="league_date"
                                           value="{{ $league->league_date ? \Carbon\Carbon::parse($league->league_date)->format('Y-m-d') : '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if($league->hasMedia('league_images'))
                                        <div class="mt-2">
                                            <img src="{{ $league->getFirstMediaUrl('league_images') }}" width="100" class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="text" class="form-label">Description</label>
                                    <textarea class="form-control" id="text" name="text" rows="3">{{ $league->text }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update League</button>
                            <a href="{{ route('admin.leagues.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
