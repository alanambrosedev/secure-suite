<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/dashboard', function () {
        return response()->json(['message' => 'welcome to dashboard']);
    })->name('dashboard');

    Route::post('/user/password', [ProfileController::class, 'updatePassword'])
        ->name('user.password.update');
});
