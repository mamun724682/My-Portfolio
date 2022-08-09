@extends('layouts.app')

@section('content')
    <div class="card mb-4" x-data="{ skill: '', submit_url: '{{ route('skills.store') }}' }">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>{{ __('Skills') }}</div>
                <button x-on:click="skill = '', submit_url = '{{ route('skills.store') }}'" class="btn btn-primary btn-sm" type="button" data-coreui-toggle="modal"
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
                    <th scope="col">Progress</th>
                    <th scope="col">Details</th>
                    <th scope="col">Serial</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($skills as $skill)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $skill->name }}</td>
                        <td>{{ $skill->progress }}%</td>
                        <td>{{ $skill->details }}</td>
                        <td>{{ $skill->serial }}</td>
                        <td>
                            @if($skill->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="d-flex align-items-center">
                            <a x-on:click="skill = {{ $skill }}, submit_url = '{{ route('skills.update', $skill->id) }}'" class="text-decoration-none me-2" href="javascript:void(0)" data-coreui-toggle="modal"
                               data-coreui-target="#exampleModalLive" title="Edit"><i class="las la-edit"></i> Edit</a>

                            <form action="{{ route('module-categories.destroy', $skill->id) }}" id="delete-form-{{ $skill->id }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-link text-decoration-none p-0" type="button" title="Delete"
                                        onclick="return makeDeleteRequest(event, {{ $skill->id }})">
                                    <i class="las la-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Data</td>
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
                        <h5 class="modal-title" id="exampleModalLiveLabel" x-text="skill ? 'Edit' : 'Create'"></h5>
                        <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" x-bind:action="submit_url">
                        @csrf

                        <template x-if="skill != ''">
                            <input type="hidden" name="_method" value="put">
                        </template>

                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="name">Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="name" name="name" type="text" x-bind:value="skill ? skill.name : ''" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="progress">Progress</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input class="form-control" id="progress" name="progress" type="number" x-bind:value="skill ? skill.progress : ''" required>
                                        <span class="input-group-text" id="progress">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save
                                <template x-if="skill != ''">
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
