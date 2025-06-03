@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Statistic Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-blue-100 p-4 rounded shadow text-center">
                    <h2 class="text-lg font-semibold">Total Waters</h2>
                    <p class="text-3xl font-bold">{{ $totalWaters }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded shadow text-center">
                    <h2 class="text-lg font-semibold">Total Suppliers</h2>
                    <p class="text-3xl font-bold">{{ $totalSuppliers }}</p>
                </div>
                <div class="bg-purple-100 p-4 rounded shadow text-center">
                    <h2 class="text-lg font-semibold">Total Transactions</h2>
                    <p class="text-3xl font-bold">{{ $totalTransactions }}</p>
                </div>
            </div>

            {{-- Water Usage by Pump --}}
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">Total Water Used per Pump</h2>
                <ul class="list-disc ml-4">
                    @foreach($waterUsage as $usage)
                        <li><strong>{{ $usage->water->pump_name ?? 'Unknown' }}</strong>: {{ $usage->total }} L</li>
                    @endforeach
                </ul>
            </div>

            {{-- Water Usage by Supplier --}}
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">Total Water Used per Supplier</h2>
                <ul class="list-disc ml-4">
                    @foreach($supplierUsage as $usage)
                        <li><strong>{{ $usage->supplier->name ?? 'Unknown' }}</strong>: {{ $usage->total }} L</li>
                    @endforeach
                </ul>
            </div>

            {{-- Page Heading + Export Button --}}
            <div class="text-center mt-3 mb-3">
                <a href="{{ route('export.statistics.pdf') }}" class="btn btn-outline-danger">
                    🧾 Export PDF
                </a>
            </div>

        </div>
    </div>
@endsection
