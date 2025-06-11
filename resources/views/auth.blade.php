<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Only check token and redirect if we're not coming from a logout
            if (!sessionStorage.getItem('logging_out')) {
                const token = sessionStorage.getItem('aisAuthToken');
                if (token) {
                    // If token exists, redirect to dashboard
                    window.location.href = '/dashboard';
                }
            }
            // Clear the logging out flag
            sessionStorage.removeItem('logging_out');
        });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white shadow-lg rounded-xl w-full max-w-sm p-8">
    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/token" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" 
                   id="username" 
                   name="username" 
                   value="{{ old('username') }}"
                   required
                   class="mt-1 block w-full px-4 py-2 border @error('username') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
            @error('username')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   required
                   class="mt-1 block w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
            Sign In
        </button>
    </form>
</div>

</body>
</html>
