<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Office Settings</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-950 p-6">

    <main class="max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
            Office Settings
        </h1>

        @if (session('success'))
            <div class="mb-4 rounded-xl bg-green-100 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST"
              action="{{ route('admin.office.update') }}"
              class="bg-white dark:bg-gray-900 rounded-2xl shadow p-6 space-y-4">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Office Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $office?->name) }}"
                    required
                    class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                >
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                >{{ old('address', $office?->address) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $office?->phone) }}"
                    class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                >
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $office?->email) }}"
                    class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                >
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Website
                </label>

                <input
                    type="text"
                    name="website"
                    value="{{ old('website', $office?->website) }}"
                    class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-gray-900 text-white py-3 hover:bg-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 transition"
            >
                Save Office Settings
            </button>

        </form>

    </main>

</body>
</html>
