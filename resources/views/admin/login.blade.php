<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-950 flex items-center justify-center">

    <div class="w-full max-w-sm px-6">

        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-6">

            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                Admin Login
            </h1>

            <form method="POST" action="/admin/login" class="mt-6 space-y-4">

                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="mt-1 w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                    >

                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="mt-1 w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full rounded-xl bg-gray-900 py-2.5 text-sm font-medium text-white hover:bg-gray-700 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200"
                >
                    Login
                </button>

            </form>

        </div>

    </div>

</body>
</html>
