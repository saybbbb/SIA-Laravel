@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Add New Transaction</h2>

    <form action="{{ route('transactions.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="water_id" class="form-label">Water Pump</label>
            <select name="water_id" class="form-select" required>
                <option value="" disabled selected>Select a pump</option>
                @foreach ($waters as $water)
                    <option value="{{ $water->id }}" {{ old('water_id') == $water->id ? 'selected' : '' }}>
                        {{ $water->pump_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select" required>
                <option value="" disabled selected>Select a supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="transaction_date" class="form-label">Transaction Date</label>
            <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="total_water_used" class="form-label">Total Water Used (L)</label>
            <input type="number" step="0.01" name="total_water_used" class="form-control" value="{{ old('total_water_used') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
