<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\AdminLeaveManageController;
use App\Http\Controllers\ManagerController;
use App\Http\Middleware\EnsureUserIsManager;
use App\Http\Middleware\EnsureUserIsEmployee;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsAdminOrManager;
use App\Http\Controllers\Admin\AdminRegistrationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ManagerLeaveController;
use App\Http\Controllers\UserManagementController;

// Protect it with admin middleware if you like
Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});


Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/admin/register', [AdminRegistrationController::class, 'show'])->name('admin.register');
    Route::post('/admin/register', [AdminRegistrationController::class, 'store'])->name('admin.store');
});
Route::middleware(['auth', EnsureUserIsEmployee::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('leave-requests', LeaveRequestController::class);
});

Route::middleware(['auth', EnsureUserIsManager::class])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::resource('manager-leave-approval', ManagerLeaveController::class);
});
Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('leave-approval', AdminLeaveManageController::class);
    Route::resource('user-management', UserManagementController::class);
    Route::put('/user/{id}/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('user.toggleStatus');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

require __DIR__ . '/auth.php';
