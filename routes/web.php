<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OfficeSettingController;
use App\Models\OfficeSetting;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\GoogleSheetController;
use App\Http\Controllers\GoogleAuthController;

Route::get('/admin/login', function () {
    if (auth()->check()) {
        return redirect()->route('admin.employees.index');
    }

    return app(AdminAuthController::class)->showLogin();
})->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

Route::middleware('web')->group(function () {
    Route::get('/admin/login/google', [GoogleAuthController::class, 'redirect'])
        ->name('google.login');

    Route::get('/admin/login/google/callback', [GoogleAuthController::class, 'callback'])
        ->name('google.callback');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('admin.employees.index');

    Route::get('/employees/create', [EmployeeController::class, 'create'])
        ->name('admin.employees.create');

    Route::post('/employees', [EmployeeController::class, 'store'])
        ->name('admin.employees.store');

    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])
        ->name('admin.employees.edit');

    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])
        ->name('admin.employees.update');

    Route::get('/office', [OfficeSettingController::class, 'edit'])
        ->name('admin.office.edit');

    Route::put('/office', [OfficeSettingController::class, 'update'])
        ->name('admin.office.update');

    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])
        ->name('admin.employees.destroy');

    Route::post('/employees/import', [EmployeeController::class, 'import'])
        ->name('admin.employees.import');

    Route::get('/employees/template', [EmployeeController::class, 'downloadTemplate'])
        ->name('admin.employees.template');

    Route::get('/google/connect', [GoogleSheetController::class, 'connect'])
        ->name('admin.google.connect');

    Route::get('/google/callback', [GoogleSheetController::class, 'callback'])
        ->name('admin.google.callback');

    Route::get('/google/test-sheets', [GoogleSheetController::class, 'testSheets'])
        ->name('admin.google.test');

    Route::get('/google/sheets', [GoogleSheetController::class, 'sheets'])
        ->name('admin.google.sheets');

    Route::get('/google/sheets/connect/{spreadsheetId}', [GoogleSheetController::class, 'connectSheet'])
        ->name('admin.google.sheets.connect');

    Route::get('/google/read-sheet', [GoogleSheetController::class, 'readSheet'])
        ->name('admin.google.read');

    Route::get('/google/sync', [GoogleSheetController::class, 'sync'])
        ->name('admin.google.sync');

    Route::get('/google/sheets/disconnect', [GoogleSheetController::class, 'disconnectSheet'])
        ->name('admin.google.sheets.disconnect');

    Route::get('/google/disconnect', [GoogleSheetController::class, 'disconnectGoogle'])
        ->name('admin.google.disconnect');
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('admin.employees.index');
    }

    return redirect()->route('admin.login');
});

Route::get('/{code}', function (string $code) {
    $employee = Employee::where('code', $code)->firstOrFail();
    $office = OfficeSetting::first();

    return view('cards.show', compact('employee', 'office'));
});
