<?php

use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-role', function () {
    return '✅ You are a super user!';
})->middleware(['auth', 'role:super']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $users = null;
        if (Auth::check() && (Auth::user()?->role?->name === 'super')) {
            $users = \App\Models\User::with('role')->latest()->paginate(10);
        }

        return view('dashboard', compact('users'));
    })->name('dashboard');

    Route::middleware(['auth', 'role:super'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
            Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        });
});

require __DIR__ . '/auth.php';
