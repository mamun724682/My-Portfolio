@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Edit Code Sample') }}
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
                    <input id="codeDescription" type="hidden" name="description" value="{{ old('description', $code->description) }}">
                    <trix-editor input="codeDescription" class="form-control"></trix-editor>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="code">Code<span class="text-danger">*</span></label>
                    <input id="code" type="hidden" name="code" value="{{ old('code', $code->code) }}" required>
                    <trix-editor input="code" class="form-control"></trix-editor>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
