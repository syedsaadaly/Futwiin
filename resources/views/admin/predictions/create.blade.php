@extends('admin.layouts.admin')
@section('content')
<style>
    .table-bordered{
        border-radius: 0px;
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px" class="page-heading">
                        {{ $pageData->pageName ?? 'Create New Prediction' }}
                    </h1>
                </div>

                <div class="card-body">
                    <form name="create_prediction_form" id="create_prediction_form" method="post"
                          action="{{ route('admin.predictions.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="team_1_id" class="form-label">Team 1*</label>
                                    <select class="form-control" id="team_1_id" name="team_1_id" required>
                                        <option value="">Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('team_1_id') == $team->id ? 'selected' : '' }}>
                                                {{ $team->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="team_2_id" class="form-label">Team 2*</label>
                                    <select class="form-control" id="team_2_id" name="team_2_id" required>
                                        <option value="">Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('team_2_id') == $team->id ? 'selected' : '' }}>
                                                {{ $team->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title*</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{ old('title') }}" required
                                           placeholder="Enter prediction title">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <small class="text-muted">Max size: 2MB | Format: jpg, png, jpeg</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="match_date" class="form-label">Match Date*</label>
                                    <input type="date" class="form-control" id="match_date" name="match_date"
                                        value="{{ old('match_date') }}" required
                                        min="{{ now()->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="match_time" class="form-label">Start Time*</label>
                                    <input type="time" class="form-control" id="match_time" name="match_time"
                                        value="{{ old('match_time', '19:00') }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="timezone" class="form-label">Timezone*</label>
                                    <select class="form-control" id="timezone" name="timezone" required>
                                        <option value="UTC" {{ old('timezone') == 'UTC' ? 'selected' : '' }}>UTC</option>
                                        <option value="Europe/London" {{ old('timezone') == 'Europe/London' ? 'selected' : '' }}>GMT</option>
                                        <option value="America/New_York" {{ old('timezone') == 'America/New_York' ? 'selected' : '' }}>EST</option>
                                        <option value="Europe/Belfast" {{ old('timezone') == 'Europe/Belfast' ? 'selected' : '' }}>BST</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_time" class="form-label">End Time*</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time"
                                           value="{{ old('end_time', '20:00') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="league_id" class="form-label">Leagues*</label>
                                    <select class="form-control" id="league_id" name="league_id" required>
                                        <option value="">Select League</option>
                                        @foreach($leagues as $league)
                                            <option value="{{ $league->id }}" {{ old('league_id') == $league->id ? 'selected' : '' }}>
                                                {{ $league->title ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="text" class="form-label">Prediction Text</label>
                                    <textarea class="form-control" id="text" name="text" rows="5"
                                              placeholder="Enter detailed prediction analysis">{{ old('text') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="teaser_text" class="form-label">Teaser Text</label>
                                    <textarea class="form-control" id="teaser_text" name="teaser_text" rows="5" required
                                              placeholder="Enter detailed prediction analysis">{{ old('teaser_text') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ml-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_teaser" name="is_teaser"
                                    {{ old('is_teaser') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_teaser">Mark as Teaser</label>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Plan Points Deduction</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Plan Name</th>
                                                <th>Points Deduction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($plans as $plan)
                                            <tr>
                                                <td>{{ $plan->name }}</td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control"
                                                        name="plan_deductions[{{ $plan->id }}]"
                                                        value="{{ old('plan_deductions.'.$plan->id, 0) }}"
                                                        min="0" required>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Create Prediction</button>
                            <a href="{{ route('admin.predictions.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
