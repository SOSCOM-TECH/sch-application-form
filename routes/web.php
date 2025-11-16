<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard (admin role only)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard');
    })->name('admin.dashboard');

    // Admin: Roles & Permissions
    Route::get('/admin/roles', [\App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('admin.roles.index');
    Route::post('/admin/roles', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storeRole'])->name('admin.roles.store');
    Route::post('/admin/permissions', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storePermission'])->name('admin.permissions.store');
    Route::post('/admin/roles/{role}/permissions', [\App\Http\Controllers\Admin\RolePermissionController::class, 'syncRolePermissions'])->name('admin.roles.permissions.sync');

    // Admin: Users
    Route::get('/admin/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [\App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('admin.users.store');

    // Admin: School registration requests
    Route::get('/admin/requests', [\App\Http\Controllers\Admin\SchoolRegistrationReviewController::class, 'index'])->name('admin.requests.index');
    Route::get('/admin/requests/{requestModel}', [\App\Http\Controllers\Admin\SchoolRegistrationReviewController::class, 'show'])->name('admin.requests.show');
    Route::post('/admin/requests/{requestModel}/approve', [\App\Http\Controllers\Admin\SchoolRegistrationReviewController::class, 'approve'])->name('admin.requests.approve');
    Route::post('/admin/requests/{requestModel}/reject', [\App\Http\Controllers\Admin\SchoolRegistrationReviewController::class, 'reject'])->name('admin.requests.reject');
});

// School representative dashboard
Route::middleware(['auth', 'verified', 'role:school_representative'])->group(function () {
    Route::get('/client', \App\Http\Controllers\Representative\DashboardController::class)->name('client.dashboard');
    Route::get('/client/school', \App\Http\Controllers\Representative\DashboardController::class)->name('client.school.dashboard');

    // Representative: Forms & Builder
    Route::get('/client/forms', [\App\Http\Controllers\Representative\FormController::class, 'index'])->name('rep.forms.index');
    Route::get('/client/forms/create', [\App\Http\Controllers\Representative\FormController::class, 'create'])->name('rep.forms.create');
    Route::post('/client/forms', [\App\Http\Controllers\Representative\FormController::class, 'store'])->name('rep.forms.store');
    Route::get('/client/forms/{form}/builder', [\App\Http\Controllers\Representative\FormController::class, 'builder'])->name('rep.forms.builder');
    Route::post('/client/forms/{form}/fields', [\App\Http\Controllers\Representative\FormController::class, 'addField'])->name('rep.forms.fields.store');
    Route::delete('/client/forms/{form}/fields/{field}', [\App\Http\Controllers\Representative\FormController::class, 'removeField'])->name('rep.forms.fields.destroy');
    Route::get('/client/forms/{form}/preview', [\App\Http\Controllers\Representative\FormController::class, 'preview'])->name('rep.forms.preview');

    // Representative: School registration request
    Route::get('/representative/registration-request', [\App\Http\Controllers\Representative\SchoolRegistrationRequestController::class, 'create'])->name('rep.requests.create');
    Route::post('/representative/registration-request', [\App\Http\Controllers\Representative\SchoolRegistrationRequestController::class, 'store'])->name('rep.requests.store');
    Route::get('/representative/registration-request/{requestModel}', [\App\Http\Controllers\Representative\SchoolRegistrationRequestController::class, 'show'])->name('rep.requests.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
