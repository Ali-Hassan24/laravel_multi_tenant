<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - {{ tenant('name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md p-5">
        <h2 class="text-xl font-bold text-blue-600 mb-6">Tenant Dashboard</h2>
        <ul class="space-y-4">
            <li><a href="/" class="text-gray-700 hover:text-blue-600">Home</a></li>
            <li><a href="{{ route('tenant.home') }}" class="text-gray-700 hover:text-blue-600">Customer</a></li>
            <!-- You can add more links here -->
        </ul>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8 overflow-y-auto">
        {{-- Topbar --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Customer List</h1>
        </div>


        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 w-1/2 mx-auto mt-4">
                {{ session('success') }}
            </div>
        @endif
        {{-- Customer Table --}}
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Customer List</h2>
                <a href="{{route('tenant.customers.create')}}" class="border-2 p-2 border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white">Add New Customer </a>

            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3 border-b">Name</th>
                        <th class="text-left p-3 border-b">Email</th>
                        <th class="text-left p-3 border-b">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border-b">{{ $customer->name }}</td>
                            <td class="p-3 border-b">{{ $customer->email }}</td>
                            <td class="px-6 py-4">
                                <a href="" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                |
                                <form action="" method="POST" onsubmit="return confirm('Are you sure?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-gray-500 p-4">No customers found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

</body>
</html>
