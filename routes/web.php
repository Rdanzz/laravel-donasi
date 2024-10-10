<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\FundraiserController;
use App\Http\Controllers\FundraisingController;
use App\Http\Controllers\FundraisingPhaseController;
use App\Http\Controllers\FundraisingWithdrawController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class)
            ->middleware('role:owner');

        Route::resource('donaturs', DonaturController::class)
            ->middleware('role:owner');

        Route::resource('fundraisers', FundraiserController::class)
            ->middleware('role:owner')->except('index');

        Route::get('fundraisers', [FundraiserController::class, 'index'])
            ->name('fundraisers.index');

        Route::resource('fundraising_withdraw', FundraisingWithdrawController::class)
            ->middleware('role:owner|fundraiser');

        Route::post(
            '/fundraising_withdraw/request/{fundraising}',
            [FundraisingWithdrawController::class, 'store']
        )->middleware('role:fundraiser')->name('fundraising_withdraw.store');

        Route::resource('fundraising_phases', FundraisingPhaseController::class)
            ->middleware('role:owner|fundraiser');

        Route::post(
            '/fundraising_phases/update/{fundraising}',
            [FundraisingPhaseController::class, 'store']
        )->middleware('role:fundraiser')->name('fundraising_phases.store');

        Route::resource('fundraising', FundraisingController::class)
            ->middleware('role:owner|fundraiser');

        Route::post(
            '/fundraising/active/{fundraising}',
            [FundraisingController::class, 'active_fundraising']
        )->middleware('role:owner')->name('fundraising.active_fundraising');

        Route::post('/fundraiser/apply', [DashboardController::class, 'apply_fundraiser'])->name('fundraiser.apply');
        Route::post('/my-withdraw', [DashboardController::class, 'my_withdraw'])->name('my-withdraw');
        Route::post('/my-withdraw/details/{fundraisingWithdraw}', [DashboardController::class, 'myWithdrawDetails'])->name('my-withdraw.details');
    });
});


require __DIR__.'/auth.php';
