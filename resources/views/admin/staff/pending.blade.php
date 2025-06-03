@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <h1 class="text-3xl font-bold mb-6">Pending Staff Registrations</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($pendingStaff->isEmpty())
        <p>No pending staff registrations at this time.</p>
    @else
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2 text-left">Name</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingStaff as $staff)
                    <tr>
                        <td class="border px-4 py-2">{{ $staff->name }}</td>
                        <td class="border px-4 py-2">{{ $staff->email }}</td>
                        <td class="border px-4 py-2 text-center space-x-2">
                            <form action="{{ route('admin.staff.approve', $staff->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('admin.staff.reject', $staff->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
