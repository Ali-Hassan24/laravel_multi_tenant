<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tenants Dashboard') }}
            </h2>
            <div>
                <a href="{{ route('Tenants.create') }}" class="p-2 bg-gray-800 text-white rounded-lg">Add Tenants</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="mt-6">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domain Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tenants as $tenant)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td> <!-- Display numeric ID -->
                                <td class="px-6 py-4">{{ $tenant->name }}</td>
                                <td class="px-6 py-4">{{ $tenant->email }}</td>
                                <td class="px-6 py-4">{{ $tenant->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    <!-- Display the first domain (if it exists) -->
                                    {{ optional($tenant->domains->first())->domain ? optional($tenant->domains->first())->domain : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('Tenants.edit', $tenant->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    |
                                    <form action="{{ route('Tenants.destroy', $tenant->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center px-6 py-4 text-gray-500">No tenants found.</td>
                            </tr>
                        @endforelse
                        </tbody>

                        <!-- Pagination Links -->
                        <tr>
                            <td colspan="6" class="px-6 py-4">
                                {{ $tenants->links() }} <!-- Display pagination links -->
                            </td>
                        </tr>
                    </table>
                </div>


            </div>
        </div>

    </div>

</x-app-layout>

