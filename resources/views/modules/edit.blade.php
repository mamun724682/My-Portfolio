@extends('layouts.app')

@section('content')
    <div class="accordion mb-4" id="accordionEditModule">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEditModule">
                <button class="accordion-button collapsed" type="button"
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
                    <div class="card-header"><strong>Code Samples</strong></div>
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
                                            <h2 class="accordion-header" id="headingSingleCode{{ $code->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-coreui-toggle="collapse" data-coreui-target="#collapseSingleCode{{ $code->id }}"
                                                        aria-expanded="false" aria-controls="collapseSingleCode{{ $code->id }}">{{ $code->name }}
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapseSingleCode{{ $code->id }}"
                                                 aria-labelledby="headingSingleCode{{ $code->id }}" data-coreui-parent="#accordionSingleCode">
                                                <div class="accordion-body">
                                                    <script class="language-markup" type="text/plain">
                          <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Accordion Item #1</button>
                              </h2>
                              <div class="accordion-collapse collapse" id="collapseOne" aria-labelledby="headingOne" data-coreui-parent="#accordionExample">
                                <div class="accordion-body"><strong>This is the first item&apos;s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It&apos;s also worth noting that just about any HTML can go within the<code>.accordion-body</code>, though the transition does limit overflow.</div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Accordion Item #2</button>
                              </h2>
                              <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-coreui-parent="#accordionExample">
                                <div class="accordion-body"><strong>This is the second item&apos;s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It&apos;s also worth noting that just about any HTML can go within the<code>.accordion-body</code>, though the transition does limit overflow.</div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Accordion Item #3</button>
                              </h2>
                              <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-coreui-parent="#accordionExample">
                                <div class="accordion-body"><strong>This is the third item&apos;s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It&apos;s also worth noting that just about any HTML can go within the<code>.accordion-body</code>, though the transition does limit overflow.</div>
                              </div>
                            </div>
                          </div>

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
