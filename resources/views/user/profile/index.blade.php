@extends('user.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header text-white pb-0" style="background-color: rgb(0, 0, 0);">
                    <h1 style="font-size: 24px">
                        {{ $pageData->pageName ?? 'Profile Settings' }}
                    </h1>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('user.profile.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First Name*</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last Name*</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                </div>
                            </div>
                        {{-- </div> --}}

                        {{-- <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email', auth()->user()->email) }}" required>
                                </div>
                            </div>
                        {{-- </div> --}}

                        {{-- <div class="row mt-3"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password"
                                           name="current_password" placeholder="Leave blank to keep current password">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password"
                                           name="new_password" placeholder="Enter new password">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                           name="new_password_confirmation" placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
