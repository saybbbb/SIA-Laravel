@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">🚰 Water Dashboard</h1>
        <p class="text-muted">Monitor and manage pump water usage with ease</p>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Add New Record Button -->
    <div class="text-center mb-4">
        <a href="{{ route('waters.create') }}" class="btn btn-success">
            ➕ Add New Record
        </a>
    </div>

    <!-- Centered Table -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="table-responsive shadow rounded bg-white p-3">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>Pump Name</th>
                            <th>Total Water Used (L)</th>
                            <th>Last Maintenance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($waters as $water)
                            <tr>
                                <td class="text-center">{{ $water->id }}</td>
                                <td>{{ $water->pump_name }}</td>
                                <td class="text-center">{{ $water->total_water_used }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($water->last_maintenance)->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('waters.show', $water->id) }}" class="btn btn-sm btn-info me-2">
                                        👁️ Show
                                    </a>

                                    <a href="{{ route('waters.edit', $water->id) }}" class="btn btn-sm btn-warning me-2">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('waters.destroy', $water->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No water records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $waters->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
