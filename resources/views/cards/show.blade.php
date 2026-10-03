<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $employee->name }} | Business Card</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-950 flex items-center justify-center p-4">

    <main class="w-full max-w-md">

        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl overflow-hidden">

            <!-- Profile -->
            <section class="text-center p-8">

<div class="mx-auto w-28 h-28 rounded-full bg-gray-200 overflow-hidden ring-4 ring-white shadow-md">

<img
    src="{{ $employee->photo
        ? asset('storage/' . $employee->photo)
        : 'https://ui-avatars.com/api/?name=' . urlencode($employee->name) . '&size=256' }}"
    alt="{{ $employee->name }}"
    class="w-full h-full object-cover"
>

</div>
<h1 class="mt-5 text-2xl font-bold text-gray-900 dark:text-white">
    {{ $employee->name }}
</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-300">
                    {{ $employee->position }}
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $employee->department }}
                </p>

            </section>

            <!-- Actions -->
<section class="px-6 pb-6 grid grid-cols-2 gap-3">

    <a href="tel:{{ $employee->phone }}"
       class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-gray-100 text-gray-900 border border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-700 py-3 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
<svg xmlns="http://www.w3.org/2000/svg"
     class="w-6 h-6"
     fill="none"
     viewBox="0 0 24 24"
     stroke="currentColor">
    <path stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M3 5a2 2 0 012-2h2.28a2 2 0 011.79 1.11l1.11 2.22a2 2 0 01-.45 2.31l-1.27 1.27a16 16 0 006.63 6.63l1.27-1.27a2 2 0 012.31-.45l2.22 1.11A2 2 0 0121 17.72V20a2 2 0 01-2 2h-1C9.72 22 2 14.28 2 5V4a2 2 0 012-2z" />
</svg>
<span class="text-xs font-medium">{{ $employee->phone }}</span>

    </a>

    <a href="mailto:{{ $employee->email }}"
       class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-gray-100 text-gray-900 border border-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-700 py-3 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
<svg xmlns="http://www.w3.org/2000/svg"
     class="w-6 h-6"
     fill="none"
     viewBox="0 0 24 24"
     stroke="currentColor">
    <path stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
</svg>
<span class="text-xs font-medium">{{ $employee->email }}</span>

    </a>

</section>

@if ($employee->socialLinks->count())
    <section class="px-6 pb-6 flex justify-center gap-3">

        @foreach ($employee->socialLinks as $social)

            <a href="{{ $social->url }}"
               target="_blank"
               rel="noopener noreferrer"
               class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-200 hover:opacity-70 transition">

                <img
                    src="{{ asset('icons/social/' . $social->platform . '.svg') }}"
                    alt=""
                    class="w-5 h-5 dark:invert"
                >

            </a>

        @endforeach

    </section>
@endif

<!-- About -->
<section class="border-t border-gray-100 dark:border-gray-800 p-6">

    <h2 class="font-semibold text-gray-900 dark:text-white">
        About
    </h2>

    @if ($employee->bio)
        <p class="mt-2 text-sm leading-6 text-gray-600 dark:text-gray-400">
            {{ $employee->bio }}
        </p>
    @endif

    @if ($office)
        <div class="mt-5 pt-4 border-t border-gray-100 dark:border-gray-800">

            <p class="text-sm font-medium text-gray-900 dark:text-white">
                {{ $office->name }}
            </p>

            @if ($office->address)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $office->address }}
                </p>
            @endif

            @if ($office->phone)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $office->phone }}
                </p>
            @endif

            @if ($office->email)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $office->email }}
                </p>
            @endif

            @if ($office->website)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $office->website }}
                </p>
            @endif

        </div>
    @endif

</section>
