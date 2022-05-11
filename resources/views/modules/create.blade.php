@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Create Modules') }}
        </div>
        <div class="card-body">
            <form action="{{ route('modules.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="category">Module Category</label>
                    <select class="form-select" name="category_id" aria-label="Default select example">

                        @forelse($module_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                        @endforelse

                    </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter module name"
                           required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <input id="description" type="hidden" name="description">
                    <trix-editor input="description" class="form-control"></trix-editor>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tags">Tags</label>
                    <input id="tags" type="text" name="tags" data-role="tagsinput" class="form-control" autocomplete="false">
                    @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check form-switch form-check-inline mb-3">
                    <input class="form-check-input" id="status" type="checkbox" name="status">
                    <label class="form-check-label" for="status">Status</label>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
          integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="{{ asset('plugins/tagsinput/tagsinput.css') }}"/>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"
            integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('plugins/tagsinput/tagsinput.js') }}"></script>
    <script>
        $("#tags").tagsinput({
            tagClass: function (item) {
                return 'badge bg-info me-1';
            },
        })
    </script>
@endpush
