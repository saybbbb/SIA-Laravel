@extends('layouts.app')

@section('content')
    <h2>{{ isset($supplier) ? 'Edit' : 'Add' }} Supplier</h2>
    <form action="{{ isset($supplier) ? route('suppliers.update', $supplier) : route('suppliers.store') }}" method="POST" class="card p-4 shadow-sm mt-3">
        @csrf
        @if(isset($supplier))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Supplier Name</label>
            <input type="text" name="name" class="form-control" value="{{ $supplier->name ?? old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $supplier->email ?? old('email') }}">
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $supplier->contact_number ?? old('contact_number') }}">
        </div>

        <button type="submit" class="btn btn-success">{{ isset($supplier) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
