<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    @if(auth()->check() && optional(auth()->user()->role)->name === 'super')
                    <div class="mt-4 flex items-center justify-between">
                        <a href="{{ route('admin.users.create') }}"
                           class="inline-flex items-center px-4 py-2 rounded-lg border border-indigo-600 text-indigo-600 hover:bg-indigo-50 transition">
                            + Create New User
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(isset($users) && auth()->check() && optional(auth()->user()->role)->name === 'super')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Users</h3>
                <div class="overflow-x-auto">
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
        </div>
    </div>
    @endif
</x-app-layout>
