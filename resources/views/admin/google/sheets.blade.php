<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sheets</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-950 min-h-screen">

    <div class="max-w-4xl mx-auto px-4 py-6">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
            Google Sheets
        </h1>
@if ($connection)
    <div class="mb-6 bg-white dark:bg-gray-900 rounded-xl shadow p-6">

        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
            Google Account
        </h2>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            Connected: {{ $connection->email }}
        </p>

        <a
            href="{{ route('admin.google.disconnect') }}"
            onclick="return confirm('Disconnect this Google account from NF?');"
            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
            Disconnect Google Account
        </a>

    </div>
@else
    <div class="mb-6 bg-white dark:bg-gray-900 rounded-xl shadow p-6">

        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
            Google Account
        </h2>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            No Google account connected.
        </p>

        <a
            href="{{ route('admin.google.connect') }}"
            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
            Connect Google Account
        </a>

    </div>
@endif
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($connection && $connection->spreadsheet_id && $connectedSheet)

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">

                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Connected Sheet
                </h2>

                <div class="mb-6">
                    <div class="font-medium text-gray-900 dark:text-white">
                        {{ $connectedSheet->getName() }}
                    </div>

                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Tab: Form Responses 1
                    </div>

                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Last sync:
                        {{ $connection->last_synced_at
                            ? $connection->last_synced_at->format('M d, Y h:i A')
                            : 'Never' }}
                    </div>
                </div>


<div class="flex gap-3">

    <a
        href="{{ route('admin.google.sync') }}"
        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
        Sync Now
    </a>

    <a
        href="{{ route('admin.google.sheets') }}"
        class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
        Refresh
    </a>

    <a
        href="{{ route('admin.google.sheets.disconnect') }}"
        onclick="return confirm('Disconnect this Google Sheet? Auto-sync will stop for this sheet.');"
        class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
        Disconnect
    </a>

</div>
            </div>

        @else

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">

                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Select a Google Sheet
                </h2>

                <div class="space-y-3">

                    @forelse ($sheets as $sheet)

                        <div class="flex items-center justify-between border border-gray-200 dark:border-gray-700 rounded-lg p-4">

                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">
                                    {{ $sheet->getName() }}
                                </div>

                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Last modified:
                                    {{ $sheet->getModifiedTime() }}
                                </div>
                            </div>

                            <a
                                href="{{ route('admin.google.sheets.connect', $sheet->getId()) }}"
                                class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                Connect
                            </a>

                        </div>

                    @empty

                        <p class="text-gray-500 dark:text-gray-400">
                            No Google Sheets found.
                        </p>

                    @endforelse

                </div>

            </div>

        @endif

    </div>

</body>
</html>
