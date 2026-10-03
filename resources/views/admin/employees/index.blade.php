<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employees</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-950 min-h-screen p-6">

    <div class="max-w-5xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Employees
            </h1>

            <a href="{{ route('admin.employees.create') }}"
               class="bg-gray-900 text-white px-4 py-2 rounded-xl">
                Add Employee
            </a>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow overflow-hidden">

            @forelse ($employees as $employee)

                <div class="p-4 border-b border-gray-100 dark:border-gray-800">
                    <div class="font-semibold text-gray-900 dark:text-white">
                        {{ $employee->name }}
                    </div>

                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $employee->position }} · {{ $employee->code }}
                    </div>
<a href="{{ route('admin.employees.edit', $employee) }}"
   class="inline-block mt-3 text-sm font-medium text-blue-600 dark:text-blue-400">
    Edit
</a>
<form method="POST"
      action="{{ route('admin.employees.destroy', $employee) }}"
      class="inline-block ml-3"
      onsubmit="return confirm('Delete this employee? This cannot be undone.');">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="text-sm font-medium text-red-600 dark:text-red-400">
        Delete
    </button>
</form>
                </div>

            @empty

                <div class="p-6 text-center text-gray-500">
                    No employees yet.
                </div>

            @endforelse

        </div>

    </div>

</body>
</html>
