@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <div>Contacts</div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($contacts as $contact)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td class="d-flex align-items-center">
                            <form action="{{ route('contacts.destroy', $contact->id) }}"
                                  id="delete-form-{{ $contact->id }}" method="post">
                                @csrf
                                @method('delete')

                                <button class="btn btn-link text-decoration-none p-0" type="button" title="Delete"
                                        onclick="return makeDeleteRequest(event, {{ $contact->id }})">
                                    <i class="las la-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
