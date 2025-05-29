@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">📦 Supplier Dashboard</h1>
            <p class="text-muted">Manage supplier information and keep track of contacts efficiently</p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Add New Record Button -->
        <div class="text-center mb-4">
            <a href="{{ route('suppliers.create') }}" class="btn btn-success">
                ➕ Add New Record
            </a>
        </div>

        <!-- Search Form -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6">
                <form action="{{ route('suppliers.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2"
                        placeholder="🔍 Search supplier name, email, or contact number">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Centered Table -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive shadow rounded bg-white p-3">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suppliers as $supplier)
                                <tr>
                                    <td class="text-center">{{ $supplier->id }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td class="text-center">{{ $supplier->email }}</td>
                                    <td class="text-center">{{ $supplier->contact_number }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('suppliers.show', $supplier->id) }}"
                                            class="btn btn-sm btn-info me-2">👁️ Show</a>
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                            class="btn btn-sm btn-warning me-2">✏️ Edit</a>
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">🗑️
                                                Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No supplier records found.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-3 mb-3">
                    <a href="{{ route('suppliers.export.pdf') }}" class="btn btn-outline-danger">
                        🧾 Export PDF
                    </a>
                </div>


                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
