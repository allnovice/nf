<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Employee</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-950 min-h-screen p-6">

    <div class="max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
            Edit Employee
        </h1>

        <form method="POST"
              action="{{ route('admin.employees.update', $employee) }}"
              enctype="multipart/form-data"
              class="bg-white dark:bg-gray-900 rounded-2xl shadow p-6 space-y-4">

            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Public Card Code
                </label>

                <input type="text"
                       name="code"
                       value="{{ $employee->code }}"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Name
                </label>

                <input type="text"
                       name="name"
                       value="{{ $employee->name }}"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Position
                </label>

                <input type="text"
                       name="position"
                       value="{{ $employee->position }}"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Department
                </label>

                <input type="text"
                       name="department"
                       value="{{ $employee->department }}"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Phone
                </label>

                <input type="text"
                       name="phone"
                       value="{{ $employee->phone }}"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ $employee->email }}"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Photo
                </label>

                @if ($employee->photo)
                    <img src="{{ asset('storage/' . $employee->photo) }}"
                         class="w-24 h-24 rounded-full object-cover mb-3">
                @endif

                <input type="file"
                       name="photo"
                       accept="image/png,image/jpeg,image/webp"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

<div>
    <label class="block text-sm font-medium mb-3 text-gray-900 dark:text-white">
        Social Links
    </label>

    <div class="space-y-3">

        @foreach ([
            'facebook',
            'instagram',
            'linkedin',
            'x',
            'github',
            'viber',
            'telegram',
            'messenger',
            'whatsapp',
            'youtube',
            'tiktok',
            'threads'
        ] as $platform)

            @php
                $social = $employee->socialLinks->firstWhere('platform', $platform);
            @endphp

            <input
                type="url"
                name="{{ $platform }}"
                value="{{ $social?->url }}"
                placeholder="{{ ucfirst($platform) }} URL"
                class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            >

        @endforeach

    </div>
</div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
                    Bio
                </label>

                <textarea name="bio"
                          rows="4"
                          class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">{{ $employee->bio }}</textarea>
            </div>

            <button type="submit"
                    class="bg-gray-900 text-white px-5 py-3 rounded-xl">
                Update Employee
            </button>

        </form>

    </div>

</body>
</html>
