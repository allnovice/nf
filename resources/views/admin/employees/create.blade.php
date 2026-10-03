<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Employee</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-950 min-h-screen p-6">

    <div class="max-w-2xl mx-auto">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
            Add Employee
        </h1>

        <form method="POST" action="{{ route('admin.employees.store') }}" enctype="multipart/form-data" class="bg-white dark:bg-gray-900 rounded-2xl shadow p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Public Card Code</label>
                <input type="text" name="code"
                       placeholder="2026-01"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Position</label>
                <input type="text" name="position"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Department</label>
                <input type="text" name="department"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Phone</label>
                <input type="text" name="phone"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>
<div>
    <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">
        Photo
    </label>

    <input
        type="file"
        name="photo"
        accept="image/png,image/jpeg,image/webp"
        class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
    >
</div>
<div>
    <label class="block text-sm font-medium mb-3 text-gray-900 dark:text-white">
        Social Links
    </label>

    <div class="space-y-3">

        <input type="url" name="facebook"
               placeholder="Facebook URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="instagram"
               placeholder="Instagram URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="linkedin"
               placeholder="LinkedIn URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="x"
               placeholder="X URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="github"
               placeholder="GitHub URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="viber"
               placeholder="Viber URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="telegram"
               placeholder="Telegram URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="messenger"
               placeholder="Messenger URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="whatsapp"
               placeholder="WhatsApp URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="youtube"
               placeholder="YouTube URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="tiktok"
               placeholder="TikTok URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

        <input type="url" name="threads"
               placeholder="Threads URL"
               class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

    </div>
</div>
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-900 dark:text-white">Bio</label>
                <textarea name="bio" rows="4"
                       class="w-full rounded-xl border border-gray-300 bg-white text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
            </div>

            <button type="submit"
                    class="bg-gray-900 text-white px-5 py-3 rounded-xl">
                Save Employee
            </button>

        </form>

    </div>

</body>
</html>
