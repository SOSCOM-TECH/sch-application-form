<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard (admin role only)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', DashboardController::class)->name('admin.dashboard');

    // Admin: Roles & Permissions
    Route::get('/admin/roles', [\App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('admin.roles.index');
    Route::post('/admin/roles', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storeRole'])->name('admin.roles.store');
    Route::post('/admin/permissions', [\App\Http\Controllers\Admin\RolePermissionController::class, 'storePermission'])->name('admin.permissions.store');
    Route::post('/admin/roles/{role}/permissions', [\App\Http\Controllers\Admin\RolePermissionController::class, 'syncRolePermissions'])->name('admin.roles.permissions.sync');

    // Admin: Users
    Route::get('/admin/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [\App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('admin.users.store');


    // Admin: Payments ledger
    Route::get('/admin/payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('admin.payments.index');

    // Admin: Packages management
    Route::resource('admin/packages', \App\Http\Controllers\Admin\PackageController::class)->names([
        'index' => 'admin.packages.index',
        'create' => 'admin.packages.create',
        'store' => 'admin.packages.store',
        'show' => 'admin.packages.show',
        'edit' => 'admin.packages.edit',
        'update' => 'admin.packages.update',
        'destroy' => 'admin.packages.destroy',
    ]);

    // Admin: Schools management
    Route::get('/admin/schools', [\App\Http\Controllers\Admin\SchoolController::class, 'index'])->name('admin.schools.index');
    Route::get('/admin/schools/{school}', [\App\Http\Controllers\Admin\SchoolController::class, 'show'])->name('admin.schools.show');
    Route::post('/admin/schools/{school}/suspend', [\App\Http\Controllers\Admin\SchoolController::class, 'suspend'])->name('admin.schools.suspend');
    Route::post('/admin/schools/{school}/activate', [\App\Http\Controllers\Admin\SchoolController::class, 'activate'])->name('admin.schools.activate');
    Route::post('/admin/schools/{school}/package', [\App\Http\Controllers\Admin\SchoolController::class, 'updatePackage'])->name('admin.schools.updatePackage');

    // Admin: Compliance
    Route::get('/admin/compliance/audits', [\App\Http\Controllers\Admin\ComplianceController::class, 'audits'])->name('admin.compliance.audits');
    Route::get('/admin/compliance/fraud', [\App\Http\Controllers\Admin\ComplianceController::class, 'fraud'])->name('admin.compliance.fraud');
});

// School representative dashboard
Route::middleware(['auth', 'verified', 'role:school_representative'])->group(function () {
    Route::get('/client', \App\Http\Controllers\Representative\DashboardController::class)->name('client.dashboard');

    // Representative: School Registration & Details
    Route::get('/client/school-registration', [\App\Http\Controllers\Representative\SchoolRegistrationController::class, 'create'])->name('rep.school-registration.create');
    Route::post('/client/school-registration', [\App\Http\Controllers\Representative\SchoolRegistrationController::class, 'store'])->name('rep.school-registration.store');
    Route::get('/client/school', [\App\Http\Controllers\Representative\SchoolRegistrationController::class, 'show'])->name('rep.school.show');

    // Representative: Forms & Builder
    Route::get('/client/forms', [\App\Http\Controllers\Representative\FormController::class, 'index'])->name('rep.forms.index');
    Route::get('/client/forms/create', [\App\Http\Controllers\Representative\FormController::class, 'create'])->name('rep.forms.create');
    Route::post('/client/forms', [\App\Http\Controllers\Representative\FormController::class, 'store'])->name('rep.forms.store');
    Route::get('/client/forms/{form}/builder', [\App\Http\Controllers\Representative\FormController::class, 'builder'])->name('rep.forms.builder');
    Route::post('/client/forms/{form}/fields', [\App\Http\Controllers\Representative\FormController::class, 'addField'])->name('rep.forms.fields.store');
    Route::delete('/client/forms/{form}/fields/{field}', [\App\Http\Controllers\Representative\FormController::class, 'removeField'])->name('rep.forms.fields.destroy');
    Route::get('/client/forms/{form}/preview', [\App\Http\Controllers\Representative\FormController::class, 'preview'])->name('rep.forms.preview');
    Route::post('/client/forms/{form}/publish', [\App\Http\Controllers\Representative\FormController::class, 'publish'])->name('rep.forms.publish');
    Route::post('/client/forms/{form}/unpublish', [\App\Http\Controllers\Representative\FormController::class, 'unpublish'])->name('rep.forms.unpublish');

    // Representative: Applicants
    Route::get('/client/applicants', [\App\Http\Controllers\Representative\ApplicantController::class, 'index'])->name('rep.applicants.index');
    Route::get('/client/applicants/{submission}', [\App\Http\Controllers\Representative\ApplicantController::class, 'show'])->name('rep.applicants.show');
    Route::get('/client/applicants-export/csv', [\App\Http\Controllers\Representative\ApplicantController::class, 'exportCsv'])->name('rep.applicants.export.csv');
    Route::get('/client/applicants-export/xlsx', [\App\Http\Controllers\Representative\ApplicantController::class, 'exportXlsx'])->name('rep.applicants.export.xlsx');
    Route::get('/client/applicants-export/pdf', [\App\Http\Controllers\Representative\ApplicantController::class, 'exportPdf'])->name('rep.applicants.export.pdf');

});

// Public applicant routes (simulation)
Route::get('/apply/{slug}', [\App\Http\Controllers\Public\ApplyController::class, 'form'])->middleware('throttle:60,1')->name('public.apply.form');
Route::post('/apply/{slug}/submit', [\App\Http\Controllers\Public\ApplyController::class, 'submit'])->middleware('throttle:20,1')->name('public.apply.submit');
Route::get('/apply/{slug}/pay', [\App\Http\Controllers\Public\ApplyController::class, 'pay'])->middleware('throttle:60,1')->name('public.apply.pay');
Route::post('/apply/{slug}/simulate', [\App\Http\Controllers\Public\ApplyController::class, 'simulate'])->middleware('throttle:20,1')->name('public.apply.simulate');
Route::get('/apply/{slug}/confirmation', [\App\Http\Controllers\Public\ApplyController::class, 'confirmation'])->name('public.apply.confirmation');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
