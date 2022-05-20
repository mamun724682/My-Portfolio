@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            {{ __('Edit Code Sample') }}
            <a href="{{ route('modules.edit', $code->module_id) }}" class="btn btn-sm btn-info text-white"><i
                    class="la la-arrow-left"></i> Back to module edit</a>
        </div>
        <div class="card-body">
            <form action="{{ route('codes.update', $code->id) }}" method="post">
                @csrf
                @method('put')

                <div class="my-3">
                    <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                    <input class="form-control" id="name" name="name" type="text"
                           placeholder="Controller, Service, View ..." value="{{ old('name', $code->name) }}" required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <input id="codeDescription" type="hidden" name="description"
                           value="{{ old('description', $code->description) }}">
                    <trix-editor input="codeDescription" class="form-control"></trix-editor>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="code_mode">Code Mode<span class="text-danger">*</span></label>
                    <select class="form-select" name="code_mode" aria-label="Default select example">

                        @forelse(\App\Models\Code::CODE_MODES as $key => $mode)
                            <option value="{{ $key }}" @selected($code->code_mode == $key)>{{ $mode }}</option>
                        @empty
                        @endforelse

                    </select>
                    @error('code_mode')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="code">Code<span class="text-danger">*</span></label>
                    <textarea name="code" id="code"
                              class="form-control codeArea">{{ old('code', $code->code) }}</textarea>
                    @error('code')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"/>

    {{--    Codemirror--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/codemirror.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/theme/monokai.min.css"/>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

    {{--    Codemirror--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/codemirror.min.js"></script>

    @if($code->code_mode == 'css')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/css/css.min.js"></script>
    @elseif ($code->code_mode == 'php')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/php/php.min.js"></script>
    @elseif ($code->code_mode == 'vue')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/vue/vue.min.js"></script>
    @elseif ($code->code_mode == 'javascript')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/javascript/javascript.min.js"></script>
    @else
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/xml/xml.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/javascript/javascript.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/css/css.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.4/mode/htmlmixed/htmlmixed.min.js"></script>
    @endif

    <script>
        var editor = CodeMirror.fromTextArea(document.querySelector('#code'), {
            lineNumbers: true,
            mode: '{{ $code->code_mode }}', // For 'htmlmixed' mode - xml, javascript, css and htmlmixed js are required
            theme: 'monokai'
        });
    </script>
@endpush
