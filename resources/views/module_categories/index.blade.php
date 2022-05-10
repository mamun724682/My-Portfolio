@extends('layouts.app')

@section('content')
    <div class="card mb-4" x-data="{ category: '', submit_url: '{{ route('module-categories.store') }}' }">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>{{ __('Module Categories') }}</div>
                <button x-on:click="category = '', submit_url = '{{ route('module-categories.store') }}'" class="btn btn-primary btn-sm" type="button" data-coreui-toggle="modal"
                        data-coreui-target="#exampleModalLive">Create
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        <td class="d-flex align-items-center">
                            <a x-on:click="category = {{ $category }}, submit_url = '{{ route('module-categories.update', $category->id) }}'" class="text-decoration-none me-2" href="javascript:void(0)" data-coreui-toggle="modal"
                               data-coreui-target="#exampleModalLive" title="Edit"><i class="las la-edit"></i> Edit</a>

                            <form action="{{ route('module-categories.destroy', $category->id) }}" id="delete-form-{{ $category->id }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-link text-decoration-none p-0" type="button" title="Delete"
                                        onclick="return makeDeleteRequest(event, {{ $category->id }})">
                                    <i class="las la-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No Data</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>

        {{--    Create and edit modal--}}
        <div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel" x-text="category ? 'Edit' : 'Create'"></h5>
                        <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" x-bind:action="submit_url">
                        @csrf

                        <template x-if="category != ''">
                            <input type="hidden" name="_method" value="put">
                        </template>

                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label" for="name">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="name" name="name" type="text" x-bind:value="category ? category.name : ''" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save
                                <template x-if="category != ''">
                                    <span>changes</span>
                                </template>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
          integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"
            integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
