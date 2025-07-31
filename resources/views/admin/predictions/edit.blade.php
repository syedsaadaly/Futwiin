@extends('admin.layouts.admin')
@section('content')\
<style>
    .table-bordered{
        border-radius: 0px;
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px">
                        {{ $pageData->pageName ?? 'Edit Prediction' }}
                    </h1>
                </div>
                <div class="card-body">
                    <form name="edit_prediction_form" id="edit_prediction_form" method="post"
                          action="{{ route('admin.predictions.update', encrypt($prediction->uuid)) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="team_1_id" class="form-label">Team 1*</label>
                                    <select class="form-control" id="team_1_id" name="team_1_id" required>
                                        <option value="">Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->uuid }}" {{ $prediction->team_1_id == $team->uuid ? 'selected' : '' }}>{{ $team->name }}</option>
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
                                            <option value="{{ $team->uuid }}" {{ $prediction->team_2_id == $team->uuid ? 'selected' : '' }}>{{ $team->name }}</option>
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
                                           value="{{ $prediction->title }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if($prediction->hasMedia('prediction_images'))
                                        <div class="mt-2">
                                            <img src="{{ $prediction->getFirstMediaUrl('prediction_images') }}" width="100" class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="match_date" class="form-label">Match Date*</label>
                                    <input type="date" class="form-control" id="match_date" name="match_date"
                                           value="{{ $prediction->match_date->format('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="match_time" class="form-label">Match Time*</label>
                                    <input type="time" class="form-control" id="match_time" name="match_time"
                                           value="{{ $prediction->match_time }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="text" class="form-label">Prediction Text</label>
                                    <textarea class="form-control" id="text" name="text" rows="5">{{ $prediction->text }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ml-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_teaser" name="is_teaser"
                                       {{ $prediction->is_teaser ? 'checked' : '' }}>
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
                                            @php
                                                $detail = $prediction->predictionDetails->where('plan_id', $plan->uuid)->first();
                                                $deduction = $detail ? $detail->points_deduction : 0;
                                            @endphp
                                            <tr>
                                                <td>{{ $plan->name }}</td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control"
                                                        name="plan_deductions[{{ $plan->uuid }}]"
                                                        value="{{ old('plan_deductions.'.$plan->uuid, $deduction) }}"
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
                            <button type="submit" class="btn btn-primary">Update Prediction</button>
                            <a href="{{ route('admin.predictions.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
