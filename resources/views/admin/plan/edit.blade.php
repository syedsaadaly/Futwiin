@extends('admin.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px" class="page-heading">
                        {{ $pageData->pageName ?? 'Edit Plan' }}
                    </h1>
                </div>
                <div class="card-body">
                    <form name="edit_plan_form" id="edit_plan_form" method="post"
                          action="{{ route('admin.plans.update', encrypt($plan->uuid)) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                           value="{{ $plan->name }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-label">Price*</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter Price"
                                           value="{{ $plan->price }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="points" class="form-label">Points*</label>
                                    <input type="number" class="form-control" id="points" name="points" placeholder="Enter Points"
                                        value="{{ $plan->points }}" required min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="predicted_view_duration_offset" class="form-label">Early Viewing Time (minutes)*</label>
                                    <input type="number" class="form-control" id="predicted_view_duration_offset" placeholder="Enter Viewing Time"
                                        name="predicted_view_duration_offset" min="1" required
                                        value="{{ $plan->predicted_view_duration_offset }}"
                                        placeholder="Enter time in minutes">
                                    <small id="timeHelpText" class="form-text text-muted"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="text" class="form-label">Description</label>
                                    <textarea class="form-control" id="text" name="text" placeholder="Enter Description" rows="3">{{ $plan->text }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update Plan</button>
                            <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('common_script')
<script>
document.getElementById('predicted_view_duration_offset').addEventListener('input', function(e) {
    const minutes = parseInt(e.target.value) || 0;
    const hours = Math.floor(minutes / 60);
    const remainingMins = minutes % 60;

    const helpText = document.getElementById('timeHelpText');
    if (helpText) {
        if (minutes < 60) {
            helpText.textContent = `${minutes} minutes`;
        } else {
            helpText.textContent = `${hours} hour${hours > 1 ? 's' : ''} ${remainingMins > 0 ? remainingMins + ' minute' + (remainingMins > 1 ? 's' : '') : ''}`;
        }
    }
});
</script>
@endsection
