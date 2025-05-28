<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if token exists in sessionStorage
            const token = sessionStorage.getItem('aisAuthToken');
            if (token) {
                // If token exists, redirect to dashboard
                window.location.href = '/dashboard';
            }
        });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white shadow-lg rounded-xl w-full max-w-sm p-8">
    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form action="/token" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" id="username" name="username" required
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
            Sign In
        </button>
    </form>
</div>

</body>
</html>
