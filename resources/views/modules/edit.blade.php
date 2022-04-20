@extends('layouts.app')

@section('content')
    @if($module->parent_id)
        <div class="text-end mb-3">
            <a href="{{ route('modules.edit', $module->parent_id) }}" class="btn btn-info text-white"><i class="la la-arrow-left"></i> Back to parent module</a>
        </div>
    @endif

    <div class="accordion mb-4" id="accordionEditModule">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEditModule">
                <button class="accordion-button collapsed h1" type="button"
                        data-coreui-toggle="collapse" data-coreui-target="#collapseEditModule"
                        aria-expanded="false" aria-controls="collapseEditModule">Edit Module
                </button>
            </h2>
            <div class="accordion-collapse collapse" id="collapseEditModule"
                 aria-labelledby="headingEditModule" data-coreui-parent="#accordionEditModule">
                <div class="accordion-body">
                    <form action="{{ route('modules.update', $module->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label class="form-label" for="type">Type</label>
                            <input class="form-control" id="type" name="type" type="text"
                                   placeholder="Ex: api, feature, samples..." value="{{ $module->type }}" required>
                            @error('type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" value="{{ $module->name }}" id="name" name="name" type="text"
                                   placeholder="Enter module name" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <input id="description" type="hidden" name="description" value="{{ $module->description }}">
                            <trix-editor input="description" class="form-control"></trix-editor>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch form-check-inline mb-3">
                            <input class="form-check-input" id="single" type="checkbox"
                                   name="is_single" @checked(old('is_single', $module->is_single))>
                            <label class="form-check-label" for="single">Is Single</label>
                            @error('is_single')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch form-check-inline mb-3">
                            <input class="form-check-input" id="status" type="checkbox"
                                   name="status" @checked(old('is_single', $module->status))>
                            <label class="form-check-label" for="status">Status</label>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <br>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if($module->is_single || $module->codes()->count() > 0)
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-warning"><strong>Code Samples</strong></div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-726"
                                                    role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Preview</a></li>
                            <li class="nav-item"><a class="nav-link" data-coreui-toggle="tab" href="#code-726"
                                                    role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-code"></use>
                                    </svg>
                                    Add Code</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-726">
                                <div class="accordion" id="accordionSingleCode">

                                    @forelse($module->codes as $code)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header d-flex" id="headingSingleCode{{ $code->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-coreui-toggle="collapse" data-coreui-target="#collapseSingleCode{{ $code->id }}"
                                                        aria-expanded="false" aria-controls="collapseSingleCode{{ $code->id }}">{{ $code->name }}
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapseSingleCode{{ $code->id }}"
                                                 aria-labelledby="headingSingleCode{{ $code->id }}" data-coreui-parent="#accordionSingleCode">
                                                <div class="accordion-body">

                                                    <div class="d-flex justify-content-end">
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle btn btn-primary" data-coreui-toggle="dropdown" href="#" role="button" aria-expanded="false">Actions</a>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="{{ route('codes.edit', $code->id) }}" title="Edit"><i class="las la-edit"></i>Edit</a></li>
                                                                <li><form action="{{ route('codes.destroy', $code->id) }}"  id="delete-form-{{ $code->id }}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="dropdown-item" onclick="return makeDeleteRequest(event, {{ $code->id }})"  type="submit" title="Delete"><i class="las la-trash-alt"></i> Delete</button></form></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    @if($code->description)
                                                        <label for="">Description</label>
                                                        <script class="language-markup" type="text/plain">
                                                            {!! html_entity_decode($code->description) !!}
                                                        </script>
                                                        <label for="" class="mt-4">Code</label>
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
                            <div class="tab-pane pt-1" role="tabpanel" id="code-726">
                                <form action="{{ route('codes.store') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="module_id" value="{{ $module->id }}">

                                    <div class="my-3">
                                        <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                                        <input class="form-control" id="name" name="name" type="text"
                                               placeholder="Controller, Service, View ..." required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <input id="codeDescription" type="hidden" name="description">
                                        <trix-editor input="codeDescription" class="form-control"></trix-editor>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="code">Code<span class="text-danger">*</span></label>
                                        <input id="code" type="hidden" name="code" required>
                                        <trix-editor input="code" class="form-control"></trix-editor>
                                        @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(!$module->parent_id && (!$module->is_single || $module->childs()->count() > 0))
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-info"><strong>Child Modules</strong></div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#child_modules_preview"
                                                    role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-media-play"></use>
                                    </svg>
                                    Preview</a></li>
                            <li class="nav-item"><a class="nav-link" data-coreui-toggle="tab" href="#child_modules_add"
                                                    role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg') }}#cil-layers"></use>
                                    </svg>
                                    Add Child Module</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="child_modules_preview">
                                <div class="accordion" id="accordionChildModule">

                                    @forelse($module->childs as $child)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header d-flex" id="headingChildModule{{ $child->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-coreui-toggle="collapse" data-coreui-target="#collapseChildModule{{ $child->id }}"
                                                        aria-expanded="false" aria-controls="collapseChildModule{{ $child->id }}">{{ $child->name }}
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapseChildModule{{ $child->id }}"
                                                 aria-labelledby="headingChildModule{{ $child->id }}" data-coreui-parent="#accordionChildModule">
                                                <div class="accordion-body">

                                                    <div class="d-flex justify-content-end">
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle btn btn-primary" data-coreui-toggle="dropdown" href="#" role="button" aria-expanded="false">Actions</a>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="{{ route('modules.edit', $child->id) }}" title="Edit"><i class="las la-edit"></i>Edit</a></li>
                                                                <li>
                                                                    <form action="{{ route('modules.destroy', $child->id) }}"  id="delete-form-{{ $child->id.$module->id }}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="dropdown-item" onclick="return makeDeleteRequest(event, {{ $child->id.$module->id }})"  type="submit" title="Delete"><i class="las la-trash-alt"></i> Delete </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div>Type: <span class="badge bg-danger">{{ ucwords($child->type) }}</span></div>
                                                    <label for="">Description</label>
                                                    <script class="language-markup" type="text/plain">
                                                        {!! html_entity_decode($child->description) !!}
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        No sample code!
                                    @endforelse

                                </div>
                            </div>
                            <div class="tab-pane pt-1" role="tabpanel" id="child_modules_add">
                                <form action="{{ route('modules.store') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="parent_id" value="{{ $module->id }}">
                                    <input type="hidden" name="is_single" value="1">

                                    <div class="mb-3">
                                        <label class="form-label" for="type">Type</label>
                                        <input class="form-control" id="type" name="type" type="text" placeholder="Ex: api, feature, samples..." required>
                                        @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter module name" required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <input id="description2" type="hidden" name="description">
                                        <trix-editor input="description2" class="form-control"></trix-editor>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <br>
                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css"/>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/unescaped-markup/prism-unescaped-markup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
@endpush
