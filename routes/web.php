<?php

use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate', [CouponController::class, 'showGenerateForm'])->name('coupons.form');
Route::post('/generate', [CouponController::class, 'generateCoupons'])->name('coupons.generate');
Route::get('/all', [CouponController::class, 'index'])->name('coupons.all');
Route::get('/{coupon}', [CouponController::class, 'show'])->name('coupons.show');
Route::get('redeem/{coupon}', [CouponController::class, 'redeem'])->name('coupons.redeem');
