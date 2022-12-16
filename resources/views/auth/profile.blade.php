@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

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
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Files
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-coreui-toggle="tab" href="#about" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    About
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-coreui-toggle="tab" href="#educations" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Educations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-coreui-toggle="tab" href="#work_process" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Work Process
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-coreui-toggle="tab" href="#social_medias" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Social Medias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-coreui-toggle="tab" href="#counters" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Counter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-coreui-toggle="tab" href="#testimonials" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Testimonials
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-coreui-toggle="tab" href="#others" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Others
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
                                                   value="{{ old('greeting', $user->greeting) }}">
                                            <label for="greeting">Greeting</label>
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
                                                   value="{{ old('phone', $user->phone) }}">
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
                                                   value="{{ old('address', $user->address) }}">
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
                                                   value="{{ old('interest', $user->interest) }}">
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
                                                   value="{{ old('current_learning', $user->current_learning) }}">
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
                                                   value="{{ old('quote', $user->quote) }}">
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
                                                   value="{{ old('status', $user->status) }}" placeholder="Online/Offline/On Vacation">
                                            <label for="status">Status</label>
                                        </div>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3 mt-0">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control"
                                                   type="password"
                                                   id="password"
                                                   name="password" placeholder="{{ __('New password') }}">
                                            <label for="password">Password</label>
                                        </div>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control"
                                                   type="password"
                                                   name="password_confirmation"
                                                   placeholder="{{ __('New password confirmation') }}">
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
                                        <img src="{{ $user->profile_image ? getImage($user->profile_image) : 'https://via.placeholder.com/400x50' }}" id="profile_image_preview" class="img-thumbnail mt-1" style="max-height: 210px;" alt="best web developer">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="banner_image" class="form-label">Banner Image</label>
                                        <input class="form-control" name="banner_image" type="file" id="banner_image" onchange="document.getElementById('banner_image_preview').src = window.URL.createObjectURL(this.files[0])">
                                        <img src="{{ $user->banner_image ? getImage($user->banner_image) : 'https://via.placeholder.com/400x50' }}" id="banner_image_preview" class="img-thumbnail mt-1" style="max-height: 210px;" alt="best software engineer">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="upload_cv" class="form-label">Add Url or Upload CV</label>
                                        <input class="form-control mb-1" placeholder="Add CV Url" name="cv_file" value="{{ str_contains($user->cv_file, 'http') ? $user->cv_file : null }}" type="url" id="upload_cv">
                                        <input class="form-control" name="cv_file" type="file" id="upload_cv">

                                        @if($user->cv_file)
                                            @if (str_contains($user->cv_file, 'http'))
                                                <a href="{{ $user->cv_file }}" target="_blank">{{ $user->cv_file }}</a>
                                            @else
                                                <a href="{{ downloadableLink($user->cv_file) }}" target="_blank">{{ str_replace('uploads/profile/','',$user->cv_file) }}</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="about">
                                <div class="row g-3">
                                    <div class="col-md-12" x-data="{ abouts: {{ $user->about ?? json_encode([['key'=> '', 'value'=> '']]) }} }">

                                        <template x-for="(about, index) in abouts" :key="index">
                                            <div class="row">
                                                <div class="form-floating col-md-5">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'about['+index+'][key]'"
                                                           x-bind:id="'about_key'+index"
                                                           x-bind:value="about['key']"
                                                    >
                                                    <label x-bind:for="'about_key'+index">Key</label>
                                                </div>
                                                <div class="form-floating col-md-5">
                                                    <textarea class="form-control"
                                                              x-bind:name="'about['+index+'][value]'"
                                                              x-bind:id="'about_value'+index"
                                                              x-bind:value="about['value']"
                                                    ></textarea>
                                                    <label x-bind:for="'about_value'+index">Value</label>
                                                </div>
                                                <button x-on:click="abouts.push({{ json_encode(['key' => '', 'value' => '']) }})" type="button" class="btn btn-info col-md-1">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-plus"></use>
                                                    </svg>
                                                </button>
                                                <button x-on:click="abouts.pop()" type="button" class="btn btn-danger col-md-1" x-show="abouts.length > 1 && index == abouts.length-1">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-trash"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="educations">
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="educations[show_education_section]" type="radio" id="show_education" value="1" @checked(json_decode($user->educations)?->show_education_section ?? 0)>
                                        <label class="form-check-label" for="show_education">Show Education Section</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="educations[show_education_section]" type="radio" id="hide_education" value="0" @checked(!json_decode($user->educations)?->show_education_section ?? 0)>
                                        <label class="form-check-label" for="hide_education">Hide Education Section</label>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    @php
                                    $educations = str_replace('"show_education_section":"1",', '', str_replace('"show_education_section":"0",','',$user->educations));
                                    @endphp
                                    <div class="col-md-12" x-data="{ educations: {{ $educations ? $educations : json_encode([['degree'=> '', 'name'=> '', 'years' => '']]) }} }">

                                        <template x-for="(education, index) in educations" :key="index">
                                            <div class="row">
                                                <div class="form-floating col-md-4">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'educations['+index+'][degree]'"
                                                           x-bind:id="'education_degree'+index"
                                                           x-bind:value="education.degree"
                                                    >
                                                    <label x-bind:for="'education_degree'+index">Degree</label>
                                                </div>
                                                <div class="form-floating col-md-4">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'educations['+index+'][name]'"
                                                           x-bind:id="'education_name'+index"
                                                           x-bind:value="education.name"
                                                    >
                                                    <label x-bind:for="'education_name'+index">Institute Name</label>
                                                </div>
                                                <div class="form-floating col-md-3">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'educations['+index+'][years]'"
                                                           x-bind:id="'education_years'+index"
                                                           x-bind:value="education.years"
                                                    >
                                                    <label x-bind:for="'education_years'+index">Years</label>
                                                </div>
                                                <div class="col-md-1 align-self-center">
                                                    <button x-on:click="educations[Object.keys(educations).length] = {{ json_encode(['degree' => '', 'name' => '', 'years' => '']) }}" type="button" class="btn btn-info btn-sm">
                                                        <svg class="icon">
                                                            <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-plus"></use>
                                                        </svg>
                                                    </button>
                                                    <button x-on:click="delete educations[index]" type="button" class="btn btn-danger btn-sm" x-show="Object.keys(educations).length > 1 && index == Object.keys(educations).length-1">
                                                        <svg class="icon">
                                                            <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-trash"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="work_process">
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="work_processes[show_work_process_section]" type="radio" id="show_work_processes" value="1" @checked(json_decode($user->work_processes)?->show_work_process_section ?? 0)>
                                        <label class="form-check-label" for="show_work_processes">Show Work Process Section</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="work_processes[show_work_process_section]" type="radio" id="hide_work_processes" value="0" @checked(!json_decode($user->work_processes)?->show_work_process_section ?? 0)>
                                        <label class="form-check-label" for="hide_work_processes">Hide Work Process Section</label>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    @php
                                        $work_processes = str_replace('"show_work_process_section":"1",', '', str_replace('"show_work_process_section":"0",','',$user->work_processes));
                                    @endphp
                                    <div class="col-md-12" x-data="{ work_processes: {{ $user->work_processes ? json_encode(json_decode($work_processes, true)) : json_encode([['key'=> '', 'value'=> '']]) }} }">

                                        <template x-for="(work_process, index) in work_processes" :key="index">
                                            <div class="row">
                                                <div class="form-floating col-md-5">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'work_processes['+index+'][key]'"
                                                           x-bind:id="'work_process_key'+index"
                                                           x-bind:value="work_process['key']"
                                                    >
                                                    <label x-bind:for="'work_process_key'+index">Key</label>
                                                </div>
                                                <div class="form-floating col-md-5">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'work_processes['+index+'][value]'"
                                                           x-bind:id="'work_process_value'+index"
                                                           x-bind:value="work_process['value']"
                                                    >
                                                    <label x-bind:for="'work_process_value'+index">Value</label>
                                                </div>
                                                <button x-on:click="work_processes.push({{ json_encode(['key' => '', 'value' => '']) }})" type="button" class="btn btn-info col-md-1">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-plus"></use>
                                                    </svg>
                                                </button>
                                                <button x-on:click="work_processes.pop()" type="button" class="btn btn-danger col-md-1" x-show="work_processes.length > 1 && index == work_processes.length-1">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-trash"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="social_medias">
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="social_medias[show_social_media_section]" type="radio" id="show_social_medias" value="1" @checked(json_decode($user->social_medias)?->show_social_media_section ?? 0)>
                                        <label class="form-check-label" for="show_social_medias">Show Social Media Section</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="social_medias[show_social_media_section]" type="radio" id="hide_social_medias" value="0" @checked(!json_decode($user->social_medias)?->show_social_media_section ?? 0)>
                                        <label class="form-check-label" for="hide_social_medias">Hide Social Media Section</label>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    @php
                                        $social_medias = str_replace('"show_social_media_section":"1",', '', str_replace('"show_social_media_section":"0",','',$user->social_medias));
                                    @endphp
                                    <div class="col-md-12" x-data="{ social_medias: {{ $user->social_medias ? json_encode(json_decode($social_medias, true)) : json_encode([['key'=> '', 'value'=> '', 'icon'=> '']]) }} }">

                                        <template x-for="(social_media, index) in social_medias" :key="index">
                                            <div class="row align-items-center">
                                                <div class="form-floating col-md-3">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'social_medias['+index+'][key]'"
                                                           x-bind:id="'social_media_key'+index"
                                                           x-bind:value="social_media['key']"
                                                    >
                                                    <label x-bind:for="'social_media_key'+index">Key</label>
                                                </div>
                                                <div class="form-floating col-md-4">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'social_medias['+index+'][value]'"
                                                           x-bind:id="'social_media_value'+index"
                                                           x-bind:value="social_media['value']"
                                                    >
                                                    <label x-bind:for="'social_media_value'+index">Value</label>
                                                </div>
                                                <div class="form-floating col-md-4">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'social_medias['+index+'][icon]'"
                                                           x-bind:id="'social_media_icon'+index"
                                                           x-bind:value="social_media['icon']"
                                                    >
                                                    <label x-bind:for="'social_media_icon'+index">Icon</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <button x-on:click="social_medias.push({{ json_encode(['key' => '', 'value' => '', 'icon' => '']) }})" type="button" class="btn btn-info btn-sm">
                                                        <svg class="icon">
                                                            <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-plus"></use>
                                                        </svg>
                                                    </button>
                                                    <button x-on:click="social_medias.pop()" type="button" class="btn btn-danger btn-sm" x-show="social_medias.length > 1 && index == social_medias.length-1">
                                                        <svg class="icon">
                                                            <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-trash"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="counters">
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="counters[show_counter_section]" type="radio" id="show_counters" value="1" @checked(json_decode($user->counters)?->show_counter_section ?? 0)>
                                        <label class="form-check-label" for="show_counters">Show Counter Section</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="counters[show_counter_section]" type="radio" id="hide_counters" value="0" @checked(!json_decode($user->counters)?->show_counter_section ?? 0)>
                                        <label class="form-check-label" for="hide_counters">Hide Counter Section</label>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    @php
                                        $counters = str_replace('"show_counter_section":"1",', '', str_replace('"show_counter_section":"0",','',$user->counters));
                                    @endphp
                                    <div class="col-md-12" x-data="{ counters: {{ $user->counters ? json_encode(json_decode($counters, true)) : json_encode([['key'=> '', 'value'=> '']]) }} }">

                                        <template x-for="(counter, index) in counters" :key="index">
                                            <div class="row align-items-center">
                                                <div class="form-floating col-md-5">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'counters['+index+'][key]'"
                                                           x-bind:id="'counter_key'+index"
                                                           x-bind:value="counter['key']"
                                                    >
                                                    <label x-bind:for="'counter_key'+index">Key</label>
                                                </div>
                                                <div class="form-floating col-md-5">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'counters['+index+'][value]'"
                                                           x-bind:id="'counter_value'+index"
                                                           x-bind:value="counter['value']"
                                                    >
                                                    <label x-bind:for="'counter_value'+index">Value</label>
                                                </div>
                                                <button x-on:click="counters.push({{ json_encode(['key' => '', 'value' => '']) }})" type="button" class="btn btn-info btn-sm col-md-1">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-plus"></use>
                                                    </svg>
                                                </button>
                                                <button x-on:click="counters.pop()" type="button" class="btn btn-danger btn-sm col-md-1" x-show="counters.length > 1 && index == counters.length-1">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-trash"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="testimonials">
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="testimonials[show_testimonial_section]" type="radio" id="show_testimonials" value="1" @checked(json_decode($user->testimonials)?->show_testimonial_section ?? 0)>
                                        <label class="form-check-label" for="show_testimonials">Show Testimonial Section</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="testimonials[show_testimonial_section]" type="radio" id="hide_testimonials" value="0" @checked(!json_decode($user->testimonials)?->show_testimonial_section ?? 0)>
                                        <label class="form-check-label" for="hide_testimonials">Hide Testimonial Section</label>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    @php
                                        $testimonials = str_replace('"show_testimonial_section":"1",', '', str_replace('"show_testimonial_section":"0",','',$user->testimonials));
                                    @endphp
                                    <div class="col-md-12" x-data="{ testimonials: {{ $user->testimonials ? json_encode(json_decode($testimonials, true)) : json_encode([['name'=> '', 'designation'=> '', 'review'=> '', 'rating'=> '']]) }} }">

                                        <template x-for="(testimonial, index) in testimonials" :key="index">
                                            <div class="row align-items-center">
                                                <div class="form-floating col-md-3">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'testimonials['+index+'][name]'"
                                                           x-bind:id="'testimonial_name'+index"
                                                           x-bind:value="testimonial['name']"
                                                    >
                                                    <label x-bind:for="'testimonial_name'+index">Name</label>
                                                </div>
                                                <div class="form-floating col-md-3">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'testimonials['+index+'][designation]'"
                                                           x-bind:id="'testimonial_designation'+index"
                                                           x-bind:value="testimonial['designation']"
                                                    >
                                                    <label x-bind:for="'testimonial_designation'+index">Designation</label>
                                                </div>
                                                <div class="form-floating col-md-4">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'testimonials['+index+'][review]'"
                                                           x-bind:id="'testimonial_review'+index"
                                                           x-bind:value="testimonial['review']"
                                                    >
                                                    <label x-bind:for="'testimonial_review'+index">Review</label>
                                                </div>
                                                <div class="form-floating col-md-1">
                                                    <input class="form-control" type="text"
                                                           x-bind:name="'testimonials['+index+'][rating]'"
                                                           x-bind:id="'testimonial_rating'+index"
                                                           x-bind:value="testimonial['rating']"
                                                    >
                                                    <label x-bind:for="'testimonial_rating'+index">Rating</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <button x-on:click="testimonials.push({{ json_encode(['name'=> '', 'designation'=> '', 'review'=> '', 'rating'=> '']) }})" type="button" class="btn btn-info btn-sm">
                                                        <svg class="icon">
                                                            <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-plus"></use>
                                                        </svg>
                                                    </button>
                                                    <button x-on:click="testimonials.pop()" type="button" class="btn btn-danger btn-sm" x-show="testimonials.length > 1 && index == testimonials.length-1">
                                                        <svg class="icon">
                                                            <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-trash"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="others">
                                <div class="card">
                                    <div class="card-header">Experience Info</div>
                                    <div class="card-body row">
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="experience_info[heading]"
                                                   id="experience_info_heading" value="{{ json_decode($user->experience_info)->heading ?? '' }}">
                                            <label for="experience_info_heading">Heading</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="experience_info[subheading]"
                                                   id="experience_info_subheading" value="{{ json_decode($user->experience_info)->subheading ?? '' }}">
                                            <label for="experience_info_subheading">Sub-heading</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2">
                                    <div class="card-header">Skill Info</div>
                                    <div class="card-body row">
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="skill_info[heading]"
                                                   id="skill_info_heading" value="{{ json_decode($user->skill_info)->heading ?? '' }}">
                                            <label for="skill_info_heading">Heading</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="skill_info[subheading]"
                                                   id="skill_info_subheading" value="{{ json_decode($user->skill_info)->subheading ?? '' }}">
                                            <label for="skill_info_subheading">Sub-Heading</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2">
                                    <div class="card-header">Portfolio Info</div>
                                    <div class="card-body row">
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="portfolio_info[heading]"
                                                   id="portfolio_info_heading" value="{{ json_decode($user->portfolio_info)->heading ?? '' }}">
                                            <label for="portfolio_info_heading">Heading</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="portfolio_info[subheading]"
                                                   id="portfolio_info_subheading" value="{{ json_decode($user->portfolio_info)->subheading ?? '' }}">
                                            <label for="portfolio_info_subheading">Sub-Heading</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2">
                                    <div class="card-header">Contact Info</div>
                                    <div class="card-body row">
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="contact_info[heading]"
                                                   id="contact_info_heading" value="{{ json_decode($user->contact_info)->heading ?? '' }}">
                                            <label for="contact_info_heading">Heading</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="contact_info[subheading]"
                                                   id="contact_info_subheading" value="{{ json_decode($user->contact_info)->subheading ?? '' }}">
                                            <label for="contact_info_subheading">Sub-Heading</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-2">
                                    <div class="card-header">Git Info</div>
                                    <div class="card-body row">
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="git_info[heading]"
                                                   id="git_info_heading" value="{{ json_decode($user->git_info)->heading ?? '' }}">
                                            <label for="git_info_heading">Heading</label>
                                        </div>
                                        <div class="form-floating col-md-6">
                                            <input class="form-control" type="text" name="git_info[subheading]"
                                                   id="git_info_subheading" value="{{ json_decode($user->git_info)->subheading ?? '' }}">
                                            <label for="git_info_subheading">Sub-Heading</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
