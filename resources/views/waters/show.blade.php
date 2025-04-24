@extends('layouts.app')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Water Pump Details</h2>

        <dl class="row">
            <dt class="col-sm-4">Pump Name</dt>
            <dd class="col-sm-8">{{ $water->pump_name }}</dd>

            <dt class="col-sm-4">Total Water Used</dt>
            <dd class="col-sm-8">{{ $water->total_water_used }} Liters</dd>

            <dt class="col-sm-4">Last Maintenance</dt>
            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($water->last_maintenance)->format('F d, Y') }}</dd>

            <dt class="col-sm-4">Health Check</dt>
            <dd class="col-sm-8">{{ $water->health_check }}</dd>
        </dl>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('waters.edit', $water) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('waters.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
