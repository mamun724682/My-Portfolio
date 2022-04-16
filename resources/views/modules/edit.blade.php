@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Edit Modules') }}
        </div>
        <div class="card-body">
            <form action="{{ route('modules.update', $module->id) }}" method="post">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label class="form-label" for="type">Type</label>
                    <input class="form-control" id="type" name="type" type="text" placeholder="Ex: api, feature, samples..." value="{{ $module->type }}" required>
                    @error('type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" value="{{ $module->name }}" id="name" name="name" type="text" placeholder="Enter module name" required>
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
                    <input class="form-check-input" id="single" type="checkbox" name="is_single" @checked(old('is_single', $module->is_single))>
                    <label class="form-check-label" for="single">Is Single</label>
                    @error('is_single')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check form-switch form-check-inline mb-3">
                    <input class="form-check-input" id="status" type="checkbox" name="status" @checked(old('is_single', $module->status))>
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
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
