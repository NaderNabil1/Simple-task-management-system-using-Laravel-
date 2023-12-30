<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// BackEnd routes
Route::prefix('admin')->middleware(['auth', 'manager'])->group(function(){
    // Dashboard route
    Route::any('/dashboard', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    });

    // User routes
    Route::prefix('users')->group(function(){
        Route::any('/', [App\Http\Controllers\Dashboard\UserController::class, 'index'])->name('users');
        Route::any('/add', [App\Http\Controllers\Dashboard\UserController::class, 'add'])->name('add-user');
        Route::any('/edit/{id}', [App\Http\Controllers\Dashboard\UserController::class, 'edit'])->name('edit-user');
        Route::any('/delete/{id}', [App\Http\Controllers\Dashboard\UserController::class, 'delete'])->name('delete-user');
        Route::any('/{id}', [App\Http\Controllers\Dashboard\UserController::class, 'show'])->name('show-user');
    });
    // Admin routes
    Route::prefix('admins')->group(function(){
        Route::any('/', [App\Http\Controllers\Dashboard\ManagerController::class, 'index'])->name('be-managers');
        Route::any('/add', [App\Http\Controllers\Dashboard\ManagerController::class, 'add'])->name('add-manager');
        Route::any('/edit/{id}', [App\Http\Controllers\Dashboard\ManagerController::class, 'edit'])->name('edit-manager');
        Route::any('/delete/{id}', [App\Http\Controllers\Dashboard\ManagerController::class, 'delete'])->name('delete-manager');
    });

    // Tasks routes
    Route::prefix('tasks')->group(function(){
        Route::any('/', [App\Http\Controllers\Dashboard\TaskController::class, 'index'])->name('be-tasks');
        Route::any('/add', [App\Http\Controllers\Dashboard\TaskController::class, 'add'])->name('add-task');
        Route::any('/edit/{id}', [App\Http\Controllers\Dashboard\TaskController::class, 'edit'])->name('edit-task');
        Route::any('/delete/{id}', [App\Http\Controllers\Dashboard\TaskController::class, 'delete'])->name('delete-task');
    });


// FrontEnd routes
Route::prefix('/')->group(function(){
    // Page routes
    Route::any('/', [App\Http\Controllers\FrontEnd\PageController::class, 'home'])->name('home');

    // Tasks routes
    Route::prefix('task')->group(function(){
        Route::any('/', [App\Http\Controllers\FrontEnd\TaskController::class, 'index'])->name('tasks');
        Route::any('/{slug}', [App\Http\Controllers\FrontEnd\TaskController::class, 'show'])->name('show-task');
    });

    // Account routes
    Route::any('/edit-account', [App\Http\Controllers\FrontEnd\UserController::class, 'edit'])->name('edit-account');
    Route::any('/reset-password', [App\Http\Controllers\FrontEnd\UserController::class, 'reset_password'])->name('reset-password');
    Route::any('/change-password', [App\Http\Controllers\FrontEnd\UserController::class, 'change_password'])->name('change-password');
});
