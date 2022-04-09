@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Modules') }}
        </div>
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@push('styles')
    @include('layouts.admin_partials.datatableCss')
@endpush

@push('scripts')
    @include('layouts.admin_partials.datatableJs')
@endpush
