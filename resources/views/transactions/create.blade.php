@extends('layouts.app')

@section('content')
    <div class="container my-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center">Add New Transaction</h2>

        <form action="{{ route('transactions.store') }}" method="POST" class="card p-4 shadow-sm mx-auto" novalidate>
            @csrf

            <div class="mb-4">
                <label for="water_id" class="form-label">Water Pump</label>
                <select name="water_id" id="water_id" class="form-select @error('water_id') is-invalid @enderror" required>
                    <option value="" disabled {{ old('water_id') ? '' : 'selected' }}>Select a pump</option>
                    @foreach ($waters as $water)
                        <option value="{{ $water->id }}" {{ old('water_id') == $water->id ? 'selected' : '' }}>
                            {{ $water->pump_name }}
                        </option>
                    @endforeach
                </select>
                @error('water_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                    <option value="" disabled {{ old('supplier_id') ? '' : 'selected' }}>Select a supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="transaction_date" class="form-label">Transaction Date</label>
                <input
                    type="date"
                    name="transaction_date"
                    id="transaction_date"
                    class="form-control @error('transaction_date') is-invalid @enderror"
                    value="{{ old('transaction_date', $transcation->transaction_date ?? '') }}"
                    required
                >
                @error('transaction_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="total_water_used" class="form-label">Total Water Used (L)</label>
                <input type="number" step="0.01" name="total_water_used" id="total_water_used"
                    class="form-control @error('total_water_used') is-invalid @enderror"
                    value="{{ old('total_water_used') }}" required>
                @error('total_water_used')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <button type="submit" class="btn btn-success px-4">Save</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
@endsection
