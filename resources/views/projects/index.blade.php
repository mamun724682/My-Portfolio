@extends('layouts.app')

@section('content')
    <div class="card mb-4" x-data="{ project: '', submit_url: '{{ route('projects.store') }}' }">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <div>Projects</div>
                        </li>
                    </ol>
                </nav>

                <button x-on:click="project = '', submit_url = '{{ route('projects.store') }}'"
                        class="btn btn-primary btn-sm" type="button" data-coreui-toggle="modal"
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
                    <th scope="col">Tags</th>
                    <th scope="col">Images</th>
                    <th scope="col">Git Url</th>
                    <th scope="col">Live Url</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($projects as $project)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->tags }}</td>
                        <td>
                            @if($project->images)
                                @foreach(json_decode($project->images) as $image)
                                    <a href="{{ getImage($image) }}" target="_blank"><img src="{{ getImage($image) }}" style="height: 50px" class="rounded" alt="Abdullah Al Mamun"></a>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $project->git }}</td>
                        <td>{{ $project->url }}</td>
                        <td>
                            @if($project->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="d-flex align-items-center">
                            <a x-on:click="project = {{ $project }}, submit_url = '{{ route('projects.update', $project->id) }}'"
                               class="text-decoration-none me-2" href="javascript:void(0)" data-coreui-toggle="modal"
                               data-coreui-target="#exampleModalLive" title="Edit"><i class="las la-edit"></i> Edit</a>

                            <form action="{{ route('projects.destroy', $project->id) }}"
                                  id="delete-form-{{ $project->id }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-link text-decoration-none p-0" type="button" title="Delete"
                                        onclick="return makeDeleteRequest(event, {{ $project->id }})">
                                    <i class="las la-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Data</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>

        {{--    Create and edit modal--}}
        <div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel" x-text="project ? 'Edit' : 'Add'"></h5>
                        <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" x-bind:action="submit_url" enctype="multipart/form-data">
                        @csrf

                        <template x-if="project != ''">
                            <input type="hidden" name="_method" value="put">
                        </template>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text"
                                           x-bind:value="project ? project.name : ''" required>
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label" for="images">Images</label>
                                    <input class="form-control" id="images" name="images[]" type="file"
                                           x-bind:value="project ? project.images : ''" multiple required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label" for="tags">Tags</label>
                                    <input class="form-control" id="tags" name="tags" type="text"
                                           x-bind:value="project ? project.tags : ''" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label" for="git">Git Url</label>
                                    <input class="form-control" id="git" name="git" type="url"
                                           x-bind:value="project ? project.git : ''">
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label" for="url">Live Url</label>
                                    <input class="form-control" id="url" name="url" type="url"
                                           x-bind:value="project ? project.url : ''">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 align-items-center">
                                    <label class="col-form-label" for="status">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="status" type="checkbox" id="status"
                                               x-bind:checked="project ? (project.status ? true : false) : true">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <textarea name="details" placeholder="Enter details" rows="5" class="form-control"
                                          x-html="project ? project.details : ''"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save
                                <template x-if="project != ''">
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
