<?php

namespace App\Http\Controllers;

use App\Models\OfficeSetting;
use Illuminate\Http\Request;

class OfficeSettingController extends Controller
{
    public function edit()
    {
        $office = OfficeSetting::first();

        return view('admin.office.edit', compact('office'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
        ]);

        OfficeSetting::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()
            ->route('admin.office.edit')
            ->with('success', 'Office settings updated successfully.');
    }
}
