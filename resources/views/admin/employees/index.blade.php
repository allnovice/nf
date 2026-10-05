<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employees</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 dark:bg-[#080e1a] dark:text-white">

<div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-8">

    {{-- =========================
         HEADER
    ========================== --}}
    <div class="mb-7">

        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
            Employees
        </h1>

        <div class="mt-5 grid grid-cols-2 gap-3 sm:flex sm:justify-end sm:gap-4">

            {{-- Add Employee --}}
            <a
                href="{{ route('admin.employees.create') }}"
                class="flex min-h-[64px] items-center justify-center gap-2 rounded-2xl bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 sm:min-h-[72px] sm:px-7 sm:text-base"
            >

                <svg
                    class="h-7 w-7 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <circle cx="9" cy="8" r="4"/>
                    <path
                        stroke-linecap="round"
                        d="M3 21a6 6 0 0 1 12 0"
                    />
                    <path
                        stroke-linecap="round"
                        d="M19 8v6M16 11h6"
                    />
                </svg>

                <span>Add Employee</span>

            </a>


            {{-- Google Sheets --}}
            <a
                href="{{ route('admin.google.sheets') }}"
                class="flex min-h-[64px] items-center justify-center gap-2 rounded-2xl border border-gray-300 bg-white px-4 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:bg-[#101827] dark:text-white dark:hover:bg-[#162033] sm:min-h-[72px] sm:px-7 sm:text-base"
            >

                <svg
                    class="h-7 w-7 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <rect x="4" y="4" width="16" height="16" rx="2"/>
                    <path
                        stroke-linecap="round"
                        d="M4 10h16M4 15h16M10 4v16M15 4v16"
                    />
                </svg>

                <span>Google Sheets</span>

            </a>

        </div>

    </div>


    {{-- =========================
         IMPORT CARD
    ========================== --}}
    <div
        class="mb-7 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-[#101827]"
    >

        <div class="px-5 pt-5">

            <div class="flex items-center gap-3">

                <svg
                    class="h-7 w-7 text-gray-700 dark:text-gray-200"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 2h9l5 5v15H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14 2v6h6M8 13h8M8 17h6"
                    />
                </svg>

                <h2 class="text-xl font-semibold">
                    Import
                </h2>

            </div>

        </div>


        <form
            method="POST"
            action="{{ route('admin.employees.import') }}"
            enctype="multipart/form-data"
            class="p-5"
        >

            @csrf

            <div class="grid gap-3 sm:grid-cols-[auto_1fr_auto]">

                {{-- Template --}}
                <a
                    href="{{ route('admin.employees.template') }}"
                    class="flex min-h-[56px] items-center justify-center gap-2 rounded-xl border border-green-200 bg-green-50 px-5 text-sm font-semibold text-green-700 transition hover:bg-green-100 dark:border-green-900 dark:bg-green-950/30 dark:text-green-400 dark:hover:bg-green-950/50"
                >

                    <svg
                        class="h-5 w-5"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm3 4v3h3V7H8Zm5 0v3h3V7h-3ZM8 12v3h3v-3H8Zm5 0v3h3v-3h-3Z"/>
                    </svg>

                    Template

                </a>


                {{-- File --}}
                <label
                    class="flex min-h-[56px] cursor-pointer items-center gap-3 rounded-xl bg-gray-100 px-4 text-sm font-medium text-gray-600 transition hover:bg-gray-200 dark:bg-[#1b2638] dark:text-gray-200 dark:hover:bg-[#223149]"
                >

                    <svg
                        class="h-6 w-6 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m16.5 6.5-7.8 7.8a3 3 0 0 0 4.2 4.2l7-7a4 4 0 0 0-5.7-5.7l-7.1 7.1a5 5 0 0 0 7.1 7.1l6.3-6.3"
                        />
                    </svg>

                    <span
                        id="file-name"
                        class="truncate"
                    >
                        Choose File
                    </span>

                    <input
                        id="excel-file"
                        type="file"
                        name="file"
                        accept=".xlsx,.xls"
                        required
                        class="hidden"
                    >

                </label>


                {{-- Import --}}
                <button
                    type="submit"
                    class="flex min-h-[56px] items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 text-sm font-semibold text-white transition hover:bg-blue-700"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            d="M12 16V4m0 0L8 8m4-4 4 4M5 20h14"
                        />
                    </svg>

                    Import

                </button>

            </div>

        </form>

    </div>


    {{-- =========================
         EMPLOYEE LIST
    ========================== --}}
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-[#101827]"
    >

        @forelse ($employees as $employee)

            <div
                class="border-b border-gray-200 px-5 py-5 last:border-b-0 dark:border-gray-800"
            >

                <div class="flex items-center gap-4">

                    {{-- Avatar --}}
                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-blue-100 text-base font-semibold text-blue-700 dark:bg-[#26344a] dark:text-white"
                    >
                        {{ strtoupper(substr($employee->name, 0, 2)) }}
                    </div>


                    {{-- Employee Information --}}
                    <div class="min-w-0 flex-1">

                        <div class="truncate text-base font-semibold text-gray-900 dark:text-white">
                            {{ $employee->name }}
                        </div>

                        <div class="mt-1 truncate text-sm text-gray-500 dark:text-gray-400">
                            {{ $employee->position }}
                        </div>

                        <a
                            href="{{ url('/' . $employee->code) }}"
                            target="_blank"
                            class="mt-2 inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-sm font-semibold text-blue-700 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50"
                        >

                            {{ $employee->code }}

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14 5h5v5M19 5l-9 9"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 13v4a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4"
                                />
                            </svg>

                        </a>

                    </div>


                    {{-- Actions --}}
                    <div class="flex shrink-0 items-center gap-2">

                        {{-- Edit --}}
                        <a
                            href="{{ route('admin.employees.edit', $employee) }}"
                            aria-label="Edit employee"
                            class="flex h-11 w-11 items-center justify-center rounded-xl border border-blue-200 text-blue-600 transition hover:bg-blue-50 dark:border-blue-900 dark:text-blue-400 dark:hover:bg-blue-950"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m16.5 3.5 4 4L8 20H4v-4L16.5 3.5Z"
                                />
                            </svg>

                        </a>


                        {{-- Delete --}}
                        <form
                            method="POST"
                            action="{{ route('admin.employees.destroy', $employee) }}"
                            onsubmit="return confirm('Delete this employee? This cannot be undone.');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                aria-label="Delete employee"
                                class="flex h-11 w-11 items-center justify-center rounded-xl border border-red-200 text-red-600 transition hover:bg-red-50 dark:border-red-900 dark:text-red-400 dark:hover:bg-red-950"
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                    />
                                </svg>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="p-10 text-center">

                <div class="font-medium text-gray-900 dark:text-white">
                    No employees yet.
                </div>

            </div>

        @endforelse

    </div>

</div>


{{-- Filename display --}}
<script>
    document.getElementById('excel-file')?.addEventListener('change', function () {
        const fileName = this.files.length
            ? this.files[0].name
            : 'Choose File';

        document.getElementById('file-name').textContent = fileName;
    });
</script>
<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button
        type="submit"
        class="rounded-lg border border-red-300 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50"
    >
        Logout
    </button>
</form>
</body>
</html>
