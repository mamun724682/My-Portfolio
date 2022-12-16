@extends('layouts.app')

@section('content')
    <div class="card mb-4" x-data="{ experience: '', submit_url: '{{ route('experiences.store') }}' }">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            @if(request()->parent_id)
                                <a href="{{ route('experiences.index') }}">Experiences</a>
                            @else
                                <div>Experiences</div>
                            @endif
                        </li>
                        @php
                            $parent = \App\Models\Experience::find(request()->parent_id);
                            if ($parent){
                                $breadcrumbs = [$parent];
                                while ($parent->parent){
                                    array_push($breadcrumbs,$parent->parent);
                                    $parent = $parent->parent;
                                }
                            }
                        @endphp

                        @if(isset($breadcrumbs))
                            @forelse(array_reverse($breadcrumbs) as $breadcrumb)
                                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                                    @if($loop->last)
                                        {{ $breadcrumb->name }}
                                    @else
                                        <a href="{{ route('experiences.index', ['parent_id' => $breadcrumb->id]) }}">{{ $breadcrumb->name }}</a>
                                    @endif
                                </li>
                            @empty
                            @endforelse
                        @endif

                    </ol>
                </nav>

                <button x-on:click="experience = '', submit_url = '{{ route('experiences.store') }}'"
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
                    <th scope="col">Company Name</th>
                    <th scope="col">Designation</th>
                    <th scope="col">From Date</th>
                    <th scope="col">To Date</th>
                    <th scope="col">Location</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($experiences as $experience)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $experience->company_name }}</td>
                        <td>{{ $experience->designation }}</td>
                        <td>{{ $experience->from_date }}</td>
                        <td>{{ $experience->to_date }}</td>
                        <td>{{ $experience->location }}</td>
                        <td>
                            @if($experience->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="d-flex align-items-center">
                            <a x-on:click="experience = {{ $experience }}, submit_url = '{{ route('experiences.update', $experience->id) }}'"
                               class="text-decoration-none me-2" href="javascript:void(0)" data-coreui-toggle="modal"
                               data-coreui-target="#exampleModalLive" title="Edit"><i class="las la-edit"></i> Edit</a>

                            <form action="{{ route('experiences.destroy', $experience->id) }}"
                                  id="delete-form-{{ $experience->id }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-link text-decoration-none p-0" type="button" title="Delete"
                                        onclick="return makeDeleteRequest(event, {{ $experience->id }})">
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
                        <h5 class="modal-title" id="exampleModalLiveLabel" x-text="experience ? 'Edit' : 'Add'"></h5>
                        <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" x-bind:action="submit_url">
                        @csrf

                        <template x-if="experience != ''">
                            <input type="hidden" name="_method" value="put">
                        </template>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label" for="name">Company Name</label>
                                    <input class="form-control" id="name" name="company_name" type="text"
                                           x-bind:value="experience ? experience.company_name : ''" required>
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label" for="designation">Designation</label>
                                    <input class="form-control" id="designation" name="designation" type="text"
                                           x-bind:value="experience ? experience.designation : ''" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label" for="from_date">From Date</label>
                                    <input class="form-control" id="from_date" name="from_date" type="date"
                                           x-bind:value="experience ? experience.from_date : ''" required>
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label" for="to_date">To Date</label>
                                    <input class="form-control" id="to_date" name="to_date" type="date"
                                           x-bind:value="experience ? experience.to_date : ''" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label" for="location">Location</label>
                                    <input class="form-control" id="location" name="location" type="text"
                                           x-bind:value="experience ? experience.location : ''" required>
                                </div>
                                <div class="col-6 align-items-center">
                                    <label class="col-form-label" for="status">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="status" type="checkbox" id="status"
                                               x-bind:checked="experience ? (experience.status ? true : false) : true">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <textarea name="details" placeholder="Enter details" rows="5" class="form-control"
                                          x-html="experience ? experience.details : ''"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save
                                <template x-if="experience != ''">
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
