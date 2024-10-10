<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\PasscodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/end-session', function () {
    request()->session()->invalidate();
    request()->session()->regenerateToken();
});
Route::get('/passcode', [PasscodeController::class, 'showForm'])->name('passcode.form');
Route::post('/passcode', [PasscodeController::class, 'verifyPasscode'])->name('passcode.verify');
Route::middleware('check.passcode')->group(function () {
    Route::get('/generate', [CouponController::class, 'showGenerateForm'])->name('coupons.form');
    Route::post('/generate', [CouponController::class, 'generateCoupons'])->name('coupons.generate');
    Route::get('/all', [CouponController::class, 'index'])->name('coupons.all');
    Route::get('/list', [CouponController::class, 'list'])->name('coupons.list');
    Route::get('/{coupon}', [CouponController::class, 'show'])->name('coupons.show');
    Route::get('download/{coupon}', [CouponController::class, 'download'])->name('coupons.download');
    Route::delete('delete/all', [CouponController::class, 'deleteAll'])->name('coupons.deleteAll');
    Route::delete('delete/{coupon}', [CouponController::class, 'delete'])->name('coupons.delete');
});
Route::get('redeem/{coupon}', [CouponController::class, 'redeem'])->name('coupons.redeem');
Route::post('redeem/{coupon}', [CouponController::class, 'confirmRedeem'])->name('coupons.confirmRedeem');

