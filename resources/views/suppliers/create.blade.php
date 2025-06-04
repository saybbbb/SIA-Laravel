@extends('layouts.app')

@section('content')
    <div class="container my-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center">{{ isset($supplier) ? 'Edit' : 'Add' }} Supplier</h2>

        <form
            action="{{ isset($supplier) ? route('suppliers.update', $supplier) : route('suppliers.store') }}"
            method="POST"
            class="card p-4 shadow-sm"
            novalidate
        >
            @csrf
            @if(isset($supplier))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="form-label">Supplier Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $supplier->name ?? '') }}"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $supplier->email ?? '') }}"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input
                    type="text"
                    name="contact_number"
                    id="contact_number"
                    class="form-control @error('contact_number') is-invalid @enderror"
                    value="{{ old('contact_number', $supplier->contact_number ?? '') }}"
                >
                @error('contact_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <button type="submit" class="btn btn-success px-4">
                    {{ isset($supplier) ? 'Update' : 'Save' }}
                </button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
@endsection
