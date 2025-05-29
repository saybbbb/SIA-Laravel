@extends('layouts.app')

@section('content')
    <h2>{{ isset($water) ? 'Edit' : 'Add' }} Water Record</h2>
    <form action="{{ isset($water) ? route('waters.update', $water) : route('waters.store') }}" method="POST" class="card p-4 shadow-sm mt-3">
        @csrf
        @if(isset($water))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="pump_name" class="form-label">Pump Name</label>
            <input type="text" name="pump_name" class="form-control" value="{{ $water->pump_name ?? old('pump_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="last_maintenance" class="form-label">Last Maintenance</label>
            <input type="date" name="last_maintenance" class="form-control" value="{{ $water->last_maintenance ?? old('last_maintenance') }}" required>
        </div>

        <div class="mb-3">
            <label for="health_check" class="form-label">Health Check</label>
            <select name="health_check" class="form-select" required>
                @foreach (['Normal', 'Warning'] as $status)
                    <option value="{{ $status }}" @if(($water->health_check ?? old('health_check')) == $status) selected @endif>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($water) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('waters.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
