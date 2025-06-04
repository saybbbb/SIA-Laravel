@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-6">

    <h1 class="text-2xl font-extrabold mb-8 text-center text-gray-900">Pending Staff Registrations</h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-900 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    @if($pendingStaff->isEmpty())
        <p class="text-center text-gray-600 text-lg">No pending staff registrations at this time.</p>
    @else
        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pendingStaff as $staff)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 text-base">{{ $staff->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 text-base">{{ $staff->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-3">
                                <form action="{{ route('admin.staff.approve', $staff->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.staff.reject', $staff->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="inline-block px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                                        Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
