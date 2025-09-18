@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold">Create User</h1>
            <p class="text-sm text-gray-500">Add a new user and assign a role.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">Back to Dashboard</a>
    </div>

    @if ($errors->any())
    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input id="name" name="name" value="{{ old('name') }}" required
                   class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Jane Doe">
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                   class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="jane@example.com">
            @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" name="password" type="password" required
                   class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="••••••••">
            @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role_id" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select id="role_id" name="role_id" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @foreach($roles as $r)
                <option value="{{ $r->id }}" @selected(old('role_id') == $r->id)>{{ $r->label ?? ucfirst($r->name) }}</option>
                @endforeach
            </select>
            @error('role_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 rounded-lg border border-indigo-600 text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                Save User
            </button>
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-800 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection