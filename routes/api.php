<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Client\BookingController as ClientBookingController;
use App\Http\Controllers\Client\TourController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\HotelController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Client\UserController;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function () {
    //route client
    Route::prefix('client')->group(function () {
        //trang chủ người dùng
        Route::get('get-tours-new', [HomeController::class, 'newTours']);
        Route::get('get-tours-feature', [HomeController::class, 'featureTours']);
        Route::get('get-posts-new', [HomeController::class, 'newPosts']);
        //tour
        Route::any('get-tours-list', [TourController::class, 'index']);
        Route::get('get-tour-detail/{slug}', [TourController::class, 'show']);
        //Hotel
        Route::get('get-hotel-detail/{id}', [HotelController::class, 'show']);
        //post
        Route::any('get-posts-list', [PostController::class, 'index']);
        Route::get('get-post-detail/{slug}', [PostController::class, 'show']);
        //booking
        Route::get('get-booking/{code}', [ClientBookingController::class, 'showByBookingCode']);
        //user
        Route::group(['prefix' => 'user'], function () {
            Route::post('get-bookings', [ClientBookingController::class, 'showByUserId']);
            Route::post('booking/update', [ClientBookingController::class, 'cancelBooking']);
            Route::post('login', [UserController::class, 'login']);
            Route::post('signup', [UserController::class, 'signup']);
            Route::post('update', [UserController::class, 'update']);
            Route::post('change-pass', [UserController::class, 'changePass']);
            Route::get('logout', [UserController::class, 'logout']);
        });
        //Quên mật khẩu
        Route::post('mail-forget-pass', [UserController::class, 'forgetPassMail']);
        Route::post('change-pass', [UserController::class, 'changeForgetPass']);

        Route::post('review-tour',[TourController::class,'review']);
        Route::post('update-payment-status/{id}', [BookingController::class, 'updatePaymentStatus']);
        Route::post('vnpayment', [PaymentController::class, 'createPayment']);
        Route::post('cashpayment', [PaymentController::class, 'cashPayment']);
        Route::post('bankingPayment', [PaymentController::class, 'bankingPayment']);
        Route::post('repay', [PaymentController::class, 'rePay']);
    });
});

// Route::get('payment-return', 'VNPayController@paymentReturn');
