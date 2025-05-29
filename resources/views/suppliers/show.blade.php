@extends('layouts.app')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Supplier Details</h2>

        <dl class="row">
            <dt class="col-sm-4">Name</dt>
            <dd class="col-sm-8">{{ $supplier->name }}</dd>

            <dt class="col-sm-4">Email</dt>
            <dd class="col-sm-8">{{ $supplier->email ?? '-' }}</dd>

            <dt class="col-sm-4">Contact Number</dt>
            <dd class="col-sm-8">{{ $supplier->contact_number ?? '-' }}</dd>
        </dl>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
