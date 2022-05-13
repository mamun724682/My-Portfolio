@extends('layouts.app')

@section('content')
    <div class="text-end mb-3">
        <a href="{{ route('modules.index') }}" class="btn btn-primary text-white"><i
                class="la la-arrow-left"></i> Go Back</a>
        <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-info text-white"><i
                class="la la-edit"></i> Edit</a>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-success">
            <strong>
                <svg class="icon me-2">
                    <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-house"></use>
                </svg>
                Show Module
            </strong>
        </div>
        <div class="card-body">
            <strong><i class="las la-play"></i>Module Category:</strong>
            {{ $module->category->name }}
            <br>
            <strong><i class="las la-play"></i>Name:</strong>
            {{ $module->name }}
            <br>
            <strong><i class="las la-play"></i>Tags:</strong>
            @forelse(explode(',', $module->tags) as $tag)
                <span class="badge bg-info">{{ $tag }}</span>
            @empty
            @endforelse
            <br>
            <strong><i class="las la-play"></i>Status:</strong>
            <span class="badge bg-{{ $module->status == \App\Models\Module::STATUS_ACTIVE ? 'success' : 'dark' }}">{{ ucwords($module->status == \App\Models\Module::STATUS_ACTIVE ? 'Active' : 'In Active') }}</span>
            <br>
            <strong><i class="las la-play"></i>Description:</strong>
            <div class="p-3 bg-success bg-opacity-25 mb-3">
                {!! $module->description !!}
            </div>
        </div>
    </div>

    <div class="row">
        @if($module->codes()->count() > 0)
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-warning">
                        <strong>
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-code"></use>
                            </svg>
                            Code Samples
                        </strong>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionSingleCode">

                            @forelse($module->codes as $code)
                                <div class="accordion-item">
                                    <h2 class="accordion-header d-flex" id="headingSingleCode{{ $code->id }}">
                                        <button class="accordion-button collapsed bg-light" type="button"
                                                data-coreui-toggle="collapse"
                                                data-coreui-target="#collapseSingleCode{{ $code->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapseSingleCode{{ $code->id }}">{{ $code->name }}
                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse" id="collapseSingleCode{{ $code->id }}"
                                         aria-labelledby="headingSingleCode{{ $code->id }}"
                                         data-coreui-parent="#accordionSingleCode">
                                        <div class="accordion-body">
                                            @if($code->description)

                                                <strong class="border-bottom">
                                                    <i class="las la-play"></i>
                                                    Description:
                                                </strong>
                                                <br>
                                                {!! html_entity_decode($code->description) !!}
                                                <br>
                                                <strong class="border-bottom">
                                                    <i class="las la-play"></i>
                                                    Code:
                                                </strong>
                                            @endif
                                            <script class="language-markup" type="text/plain">
                                                {!! html_entity_decode($code->code) !!}
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No sample code!
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($module->childs()->count() > 0)
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-info">
                        <strong>
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-child"></use>
                            </svg>
                            Child Modules
                        </strong>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($module->childs as $child)
                                <li class="nav-item">
                                    <a @class(['nav-link', 'active' => $loop->first]) data-coreui-toggle="tab"
                                                        href="#child_modules_preview_{{ $child->id }}"
                                                        role="tab">
                                        <svg class="icon me-1">
                                            <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-layers"></use>
                                        </svg>
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content rounded-bottom">

                            @foreach($module->childs as $child)
                                <div @class(['tab-pane p-3', 'active preview' => $loop->first]) role="tabpanel" id="child_modules_preview_{{ $child->id }}">

                                    <strong><i class="las la-play"></i>Description:</strong>
                                    <div class="p-3 bg-info bg-opacity-25 mb-3">
                                        {!! $child->description !!}
                                    </div>

                                    <strong><i class="las la-play"></i>Codes:</strong>
                                    <div class="accordion" id="accordionChildModule">

                                        @forelse($child->codes as $code)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header d-flex" id="headingChildModule{{ $code->id }}">
                                                    <button class="accordion-button collapsed bg-light" type="button"
                                                            data-coreui-toggle="collapse"
                                                            data-coreui-target="#collapseChildModule{{ $code->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapseChildModule{{ $code->id }}">{{ $code->name }}
                                                    </button>
                                                </h2>
                                                <div class="accordion-collapse collapse"
                                                     id="collapseChildModule{{ $code->id }}"
                                                     aria-labelledby="headingChildModule{{ $code->id }}"
                                                     data-coreui-parent="#accordionChildModule">
                                                    <div class="accordion-body">

                                                        <strong>
                                                            <svg class="icon me-2">
                                                                <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-code"></use>
                                                            </svg>
                                                            Description:
                                                        </strong>
                                                        {!! $code->description !!}
                                                        <br>
                                                        <strong>
                                                            <svg class="icon me-2">
                                                                <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-code"></use>
                                                            </svg>
                                                            Code:
                                                        </strong>
                                                        <script class="language-markup" type="text/plain">
                                                            {!! html_entity_decode($child->description) !!}
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            No data found!
                                        @endforelse

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css"/>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/autoloader/prism-autoloader.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/unescaped-markup/prism-unescaped-markup.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
@endpush
