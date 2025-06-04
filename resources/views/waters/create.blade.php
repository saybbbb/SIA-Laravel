@extends('layouts.app')

@section('content')
    <div class="container my-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center">{{ isset($water) ? 'Edit' : 'Add' }} Water Record</h2>

        <form
            action="{{ isset($water) ? route('waters.update', $water) : route('waters.store') }}"
            method="POST"
            class="card p-4 shadow-sm"
            novalidate
        >
            @csrf
            @if(isset($water))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="pump_name" class="form-label">Pump Name</label>
                <input
                    type="text"
                    name="pump_name"
                    id="pump_name"
                    class="form-control @error('pump_name') is-invalid @enderror"
                    value="{{ old('pump_name', $water->pump_name ?? '') }}"
                    required
                >
                @error('pump_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="last_maintenance" class="form-label">Last Maintenance</label>
                <input
                    type="date"
                    name="last_maintenance"
                    id="last_maintenance"
                    class="form-control @error('last_maintenance') is-invalid @enderror"
                    value="{{ old('last_maintenance', $water->last_maintenance ?? '') }}"
                    required
                >
                @error('last_maintenance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="health_check" class="form-label">Health Check</label>
                <select
                    name="health_check"
                    id="health_check"
                    class="form-select @error('health_check') is-invalid @enderror"
                    required
                >
                    @foreach (['Normal', 'Warning'] as $status)
                        <option
                            value="{{ $status }}"
                            {{ (old('health_check', $water->health_check ?? '') == $status) ? 'selected' : '' }}
                        >
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('health_check')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <button type="submit" class="btn btn-success px-4">
                    {{ isset($water) ? 'Update' : 'Save' }}
                </button>
                <a href="{{ route('waters.index') }}" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
@endsection
