@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px" class="page-heading">
                        {{ $pageData->pageName ?? 'Edit Team' }}
                    </h1>
                </div>
                <div class="card-body">
                    <form name="edit_team_form" id="edit_team_form" method="post"
                          action="{{ route('admin.teams.update', encrypt($team->uuid)) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Team Name*</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $team->name }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update Team</button>
                            <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
