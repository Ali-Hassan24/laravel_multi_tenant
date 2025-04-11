<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Login - {{ tenant('name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white p-10 rounded-lg shadow-md w-full max-w-md text-center">
    <h1 class="text-3xl font-bold text-blue-600 mb-4">Tenant Login</h1>

    @if($errors && $errors->any())
        <div class="bg-red-100 text-red-700 border border-red-400 rounded p-4 mb-4">
            Please fix the errors below.
        </div>
    @endif
    <form method="POST" action="{{ route('tenant.login') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="email" class="block text-left">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <label for="password" class="block text-left">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>
            </div>
        </div>
    </form>

{{--    <a href="{{ route('login') }}" class="mt-4 text-blue-600 hover:underline">Back to Main System Login</a>--}}
</div>
</body>
</html>
