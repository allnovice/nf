<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SocialLink;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('name')->get();

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }
public function update(Request $request, Employee $employee)
{
    $validated = $request->validate([
        'code' => 'required|string|max:255|unique:employees,code,' . $employee->id,
        'name' => 'required|string|max:255',
        'position' => 'nullable|string|max:255',
        'department' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'bio' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
    ]);


if ($request->hasFile('photo')) {
    if ($employee->photo) {
        Storage::disk('public')->delete($employee->photo);
    }

    $validated['photo'] = $request->file('photo')->store('employees', 'public');
}
    $employee->update($validated);
$socials = [
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
    'threads',
];

foreach ($socials as $platform) {
    $url = $request->input($platform);

    if ($url) {
        $employee->socialLinks()->updateOrCreate(
            ['platform' => $platform],
            ['url' => $url]
        );
    } else {
        $employee->socialLinks()
            ->where('platform', $platform)
            ->delete();
    }
}
    return redirect()
        ->route('admin.employees.index')
        ->with('success', 'Employee updated successfully.');
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:employees,code',
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $employee = Employee::create($validated);
$socials = [
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
    'threads',
];

foreach ($socials as $platform) {
    if ($request->filled($platform)) {
        $employee->socialLinks()->create([
            'platform' => $platform,
            'url' => $request->input($platform),
        ]);
    }
}
        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee added successfully.');
    }

}
