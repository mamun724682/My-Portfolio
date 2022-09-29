@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header"><strong>Full Profile</strong></div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-coreui-toggle="tab" href="#profile" role="tab">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-coreui-toggle="tab" href="#files" role="tab">
                                <svg class="icon me-2">
                                    <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-code"></use>
                                </svg>
                                Files
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="profile">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="greeting"
                                               id="greeting"
                                               value="{{ old('greeting', $user->greeting) }}" required>
                                        <label for="name">Greeting</label>
                                    </div>
                                    @error('greeting')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="name"
                                               placeholder="{{ __('Name') }}"
                                               id="name"
                                               value="{{ old('name', $user->name) }}" required>
                                        <label for="name">Name</label>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="email" name="email"
                                               placeholder="{{ __('Email') }}"
                                               id="email"
                                               value="{{ old('email', $user->email) }}" required>
                                        <label for="email">Email</label>
                                    </div>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="phone"
                                               id="phone"
                                               value="{{ old('phone', $user->phone) }}" required>
                                        <label for="phone">Phone</label>
                                    </div>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="address"
                                               id="address"
                                               value="{{ old('address', $user->address) }}" required>
                                        <label for="address">Address</label>
                                    </div>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="designation"
                                               id="designation"
                                               value="{{ old('designation', $user->designation) }}" required>
                                        <label for="designation">Designation</label>
                                    </div>
                                    @error('designation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="interest"
                                               id="interest"
                                               value="{{ old('interest', $user->interest) }}" required>
                                        <label for="interest">Interest</label>
                                    </div>
                                    @error('interest')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="current_learning"
                                               id="current_learning"
                                               value="{{ old('current_learning', $user->current_learning) }}" required>
                                        <label for="current_learning">Current Learning</label>
                                    </div>
                                    @error('current_learning')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="quote"
                                               id="quote"
                                               value="{{ old('quote', $user->quote) }}" required>
                                        <label for="quote">Quote</label>
                                    </div>
                                    @error('quote')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="status"
                                               id="status"
                                               value="{{ old('status', $user->status) }}" required>
                                        <label for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                               type="password"
                                               id="password"
                                               name="password" placeholder="{{ __('New password') }}" required>
                                        <label for="password">Password</label>
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                               type="c_password"
                                               name="password_confirmation"
                                               placeholder="{{ __('New password confirmation') }}" required>
                                        <label for="c_password">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane pt-1" role="tabpanel" id="files">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="profile_image" class="form-label">Profile Image</label>
                                    <input class="form-control" type="file" name="profile_image" id="profile_image" onchange="document.getElementById('profile_image_preview').src = window.URL.createObjectURL(this.files[0])">
                                    <img src="{{ $user->profile_image ?? 'https://via.placeholder.com/400x50' }}" id="profile_image_preview" class="img-thumbnail mt-1" style="max-height: 210px;" alt="best web developer">
                                </div>
                                <div class="col-md-6">
                                    <label for="banner_image" class="form-label">Banner Image</label>
                                    <input class="form-control" name="banner_image" type="file" id="banner_image" onchange="document.getElementById('banner_image_preview').src = window.URL.createObjectURL(this.files[0])">
                                    <img src="{{ $user->banner_image ?? 'https://via.placeholder.com/400x50' }}" id="banner_image_preview" class="img-thumbnail mt-1" style="max-height: 210px;" alt="best web developer">
                                </div>
                                <div class="col-md-12">
                                    <label for="upload_cv" class="form-label">Upload CV</label>
                                    <input class="form-control" name="cv_file" type="file" id="upload_cv">
                                    <a href="#" target="_blank">File name</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
