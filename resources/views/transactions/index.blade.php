@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">💧 Transactions</h1>
            <p class="text-muted">Track water usage between pumps and suppliers</p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Add New Record Button -->
        <div class="text-center mb-4">
            <a href="{{ route('transactions.create') }}" class="btn btn-success">
                ➕ Add New Transaction
            </a>
        </div>

        <!-- Search Form -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6">
                <form action="{{ route('transactions.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                        placeholder="🔍 Search water pump or supplier name">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive shadow rounded bg-white p-3">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>ID</th>
                                <th>Water Pump</th>
                                <th>Supplier</th>
                                <th>Date</th>
                                <th>Total Water Used (L)</th>
                                @if(auth()->user()->role === 'admin')
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td class="text-center">{{ $transaction->id }}</td>
                                    <td>{{ $transaction->water->pump_name }}</td>
                                    <td>{{ $transaction->supplier->name }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') }}
                                    </td>
                                    <td class="text-center">{{ $transaction->total_water_used }}</td>

                                    @if(auth()->user()->role === 'admin')
                                        <td class="text-center">
                                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                class="btn btn-sm btn-warning me-1">✏️ Edit</a>

                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No transactions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('transactions.export.pdf') }}" class="btn btn-outline-danger">
                        🧾 Export PDF
                    </a>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
