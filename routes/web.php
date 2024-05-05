<?php

use App\Enums\Can;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Auth\Password\{Recovery, Reset};
use App\Livewire\Auth\{EmailValidation, Login, Register};
use App\Livewire\{Customers, Welcome};
use Illuminate\Support\Facades\Route;

#region Loginflow
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('auth.register');
Route::get('/email-validation', EmailValidation::class)->middleware('auth')->name('auth.email-validation');
Route::get('/logout', fn () => auth()->logout())->name('auth.logout');
Route::get('/password/recovery', Recovery::class)->name('password.recovery');
Route::get('/password/reset', Reset::class)->name('password.reset');
#endregion

#region Authenticated
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', Welcome::class)->name('dashboard');

    #region Customer
    Route::get('/customers', Customers\Index::class)->name('customers');
    #endregion

    #region Admin
    Route::prefix('/admin')->middleware('can:' . Can::BE_AN_ADMIN->value)->group(function () {
        Route::get('/', Dashboard::class)->name('admin.dashboard');
        Route::get('/users', Index::class)->name('admin.users');
    });
    #endregion

});
#endregion
