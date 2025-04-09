<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Customer - {{ tenant('name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

{{-- Success & Error Messages --}}
<div class="max-w-lg mx-auto mt-6">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-400 rounded p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors && $errors->any())
        <div class="bg-red-100 text-red-700 border border-red-400 rounded p-4 mb-4">
            Please fix the errors below.
        </div>
    @endif
</div>

{{-- Form Card --}}
<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Customer</h2>

    <form method="POST" action="{{ route('tenant.customers.store') }}">
        @csrf

        {{-- Name --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1" for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1" for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-1" for="password">Password</label>
            <input type="password" name="password" id="password"
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Create Customer
            </button>
        </div>
    </form>
</div>

</body>
</html>
