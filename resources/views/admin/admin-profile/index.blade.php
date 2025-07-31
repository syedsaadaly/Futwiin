@extends('admin.layouts.admin')
@section('content')
         <style>
.password-box {
    margin-top: 5px;
     margin-bottom: 5px;
  background-color: #e5e5e5;
  border-radius: 5px;
  opacity: 0;
  max-height: 0;
  overflow: hidden;
  padding: 0;

  transition: all 0.5s ease}

.password-box.show {
  opacity: 1;
  max-height: 400px;
 
}
.password-list{
 padding: 10px 20px;
  transition: all 0.5s ease;
  list-style: none !important;
  margin:0;

}

.password-list li {
  position: relative;
  padding-left: 20px;
  font-weight: 600;
  font-size:12px;
}

.password-list li:before {
  content: "\2022"; 
  font-size: 14px;
  position: absolute;
  left: 0;
  top: -2px;
}

.valid {
  color: #65b891;

}

.no-valid {
    color: #262626;

 
}
.password-list li.valid:before {
  content: "\2713"; 
  font-size: 14px;
  position: absolute;
  left: 0;
  top: 0;
  color: #65b891;
}

.progress-bar {
  width: 100%;
  height: 5px;
  background-color: #ccc;
  border-radius: 5px;
  overflow: hidden;
}

.progress {
  width: 0%;
  height: 100%;
  background-color: #65b891;
  transition: width 0.5s ease;
}



    </style>
    <div class="row">
        <div class="col-12">
            <!-- Profile Update Form -->
            <form name="update_profile_form" enctype="multipart/form-data" id="update_profile_form" method="post"
                action="{{ route('admin.updateProfile') }}">
                @csrf
                <div class="card card-primary card-info">
                    <div class="card-header">
                        <h3 class="card-title text-white">
                            Profile Information
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $user->firstname ?? '' }}"
                                            name="first_name" placeholder="First Name" required>
                                    </div>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $user->lastname ?? '' }}"
                                            name="last_name" placeholder="Last Name" required>
                                    </div>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" value="{{ $user->email ?? '' }}"
                                            name="email" readonly>
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Profile Image 
                                        <small class="text-muted ms-1">
                                            (<strong>Recommended Dimensions:</strong> 120 × 120 pixels)
                                        </small>
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="profile_image"
                                                id="profileImageInput">
                                            <label class="custom-file-label" for="profileImageInput">Choose file</label>
                                        </div>
                                    </div>
                                    {{-- <small class="text-muted">Allowed formats: jpg, png, jpeg</small> --}}

                                    @if (!empty($user->image))
                                        <div class="form-group mt-2">
                                            <a href="{{ asset('storage/' . $user->image) }}" target="_blank" class="">
                                                <h6 style="font-size: 14px">View Profile Image</h6>
                                            </a>
                                        </div>
                                    @endif

                                    {{-- <div class="form-group mt-2">
                                    <img id="profileImagePreview" src="{{ $user->image ? asset('storage/'.$user->image) : asset('default-profile.png') }}" 
                                         class="img-fluid rounded" style="max-width: 150px;">
                                </div> --}}
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update_profile" class="btn btn-primary float-right"
                            value="update_profile">Update Profile</button>
                    </div>
                </div>
            </form>

            <!-- Password Update Form -->
            <form name="update_password_form" id="update_password_form" method="post"
                action="{{ route('admin.updatePassword') }}">
                @csrf
                <div class="card card-primary card-info">
                    <div class="card-header">
                        <h3 class="card-title text-white">
                            Update Password
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                            id="current_password" name="current_password" placeholder="Enter current password" required />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-block input-group-text">
                                                <i class="fa fa-eye-slash password-icon-js" data-input="current_password"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                            id="new_password" name="new_password" placeholder="Enter new password" required />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-block input-group-text">
                                                <i class="fa fa-eye-slash password-icon-js" data-input="new_password"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="password-box">
                                        <ul class="password-list">
                                            <li class="eight-character">Must have at least 8 characters</li>
                                            <li class="one-number">Must have at least 1 number</li>
                                            <li class="one-letter">Must have at least 1 letter</li>
                                            <li class="one-character">Must have at least 1 special character [@,#,$,%,etc]</li>
                                        </ul>
                                        <div class="progress-bar">
                                            <div class="progress"></div>
                                        </div>
                                    </div>
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('confirm_new_password') is-invalid @enderror"
                                            id="confirm_new_password" name="confirm_new_password" placeholder="Enter confirm password" required />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-block input-group-text">
                                                <i class="fa fa-eye-slash password-icon-js" data-input="confirm_new_password"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('confirm_new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update_password" class="btn btn-primary float-right"
                            value="update_password">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('common_script')
    <script>
        $(function() {
            $('#frontend_footer_content').summernote({
                height: 350
            });
            $('#admin_footer_content').summernote({
                height: 350
            });

            bsCustomFileInput.init();
        });
    </script>
    <script>
        document.getElementById("profileImageInput").addEventListener("change", function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById("profileImagePreview").src = URL.createObjectURL(file);
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let newPassword = document.querySelector("input[name='new_password']");
            let confirmPassword = document.querySelector("input[name='confirm_new_password']");

            let newPasswordError = document.createElement("small");
            newPasswordError.style.color = "red";
            newPasswordError.style.display = "block";
            newPasswordError.style.marginTop = "5px";
            newPassword.closest('.form-group').appendChild(newPasswordError);

            let confirmPasswordError = document.createElement("small");
            confirmPasswordError.style.color = "red";
            confirmPasswordError.style.display = "block";
            confirmPasswordError.style.marginTop = "5px";
            confirmPassword.closest('.form-group').appendChild(confirmPasswordError);

            function validatePassword() {
                let password = newPassword.value;
                let confirmPass = confirmPassword.value;

                let specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

                if (password.length < 8) {
                    // newPasswordError.textContent = "Password must be at least 8 characters long!";
                    newPassword.style.borderColor = "red";
                } else if (!specialCharRegex.test(password)) {
                    // newPasswordError.textContent = "Password must contain at least one special character!";
                    newPassword.style.borderColor = "red";
                } else {
                    newPasswordError.textContent = "";
                    newPassword.style.borderColor = "";
                }

                if (confirmPass.length > 0 && password !== confirmPass) {
                    confirmPasswordError.textContent = "Passwords do not match!";
                    confirmPassword.style.borderColor = "red";
                } else {
                    confirmPasswordError.textContent = "";
                    confirmPassword.style.borderColor = "";
                }
            }

            newPassword.addEventListener("input", validatePassword);
            confirmPassword.addEventListener("input", validatePassword);
        });
        $(document).ready(function () {
   
            const passwordInput = $('#new_password');
            
            const passwordBox = $('.password-box');
            const progressBar = $('.progress');

            const eightCharacterLi = $('.eight-character');
            const oneNumberLi = $('.one-number');
            const oneLetterLi = $('.one-letter');
            const oneCharacterLi = $('.one-character');

            let touchedFields = {};

            passwordBox.removeClass('show');

            passwordInput.on('focus', function () {
                passwordBox.addClass('show');
            });

            passwordInput.on('blur', function () {
                if ($(this).val().trim() === '') {
                    passwordBox.removeClass('show');
                }
            });

            passwordInput.on('input', function () {
                const password = $(this).val();
                let progress = 0;

                const hasLength = password.length >= 8;
                const hasNumber = /\d/.test(password);
                const hasLetter = /[a-zA-Z]/.test(password);
                const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

                updateConditionItem(eightCharacterLi, hasLength);
                updateConditionItem(oneNumberLi, hasNumber);
                updateConditionItem(oneLetterLi, hasLetter);
                updateConditionItem(oneCharacterLi, hasSpecial);

                if (hasNumber) progress += 25;
                if (hasLetter) progress += 25;
                if (hasSpecial) progress += 25;
                if (hasLength) progress += 25;

                progressBar.css('width', progress + '%');

                touchedFields['password'] = true;
                validatePassword();
            });

            function updateConditionItem(item, isValid) {
                if (isValid) {
                    item.addClass('valid').css('color', '#65b891');
                } else {
                    item.removeClass('valid').css('color', '#424646');
                }
            }

            function toggleInvalidClass(input, hasError) {
                const wrapper = input.closest('.input-wrapper');
                if (wrapper.length) {
                    wrapper.toggleClass('is-invalid', hasError);
                }
            }

            function validatePassword() {
                const password = passwordInput.val().trim();
                let isValid = true;
                let errorMessages = [];

                const hasLength = password.length >= 8;
                const hasNumber = /\d/.test(password);
                const hasLetter = /[a-zA-Z]/.test(password);
                const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

                if (password.length > 0) {
                    if (!hasLength) {
                        errorMessages.push('at least 8 characters');
                        isValid = false;
                    }
                    if (!hasNumber) {
                        errorMessages.push('at least one number');
                        isValid = false;
                    }
                    if (!hasLetter) {
                        errorMessages.push('at least one letter');
                        isValid = false;
                    }
                    if (!hasSpecial) {
                        errorMessages.push('at least one special character');
                        isValid = false;
                    }
                }

                toggleInvalidClass(passwordInput, !isValid && password.length > 0);

                if (touchedFields['password'] && password.length > 0) {
                    passwordError.text(isValid ? '' : 'Password must contain ' + errorMessages.join(', ') + '.');
                } else {
                    passwordError.text('');
                }

                return isValid;
            }
        });
    </script>
@endsection
