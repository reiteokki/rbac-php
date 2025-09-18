@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Users</h1>
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white shadow hover:bg-indigo-700 transition">
            + Add New User
        </a>
    </div>


    @if(session('status'))
    <div class="mb-4 p-3 bg-green-100 rounded">{{ session('status') }}</div>
    @endif

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3">Name</th>
                    <th class="text-left px-4 py-3">Email</th>
                    <th class="text-left px-4 py-3">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $u->name }}</td>
                    <td class="px-4 py-3">{{ $u->email }}</td>
                    <td class="px-4 py-3">{{ $u->role?->label ?? $u->role?->name ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection