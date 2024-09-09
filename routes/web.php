<?php


use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\Hotel_CommentController;
use App\Http\Controllers\Admin\Hotel_ImageController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TourTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\HotelServiceController;
use App\Http\Controllers\Admin\StasticController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
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
Route::fallback(function () {
    return redirect()->back();
});

Route::get('/', function () {
    return redirect()->route('auth.form');
});
Route::get('/login', [AuthController::class, 'form'])->name('auth.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::any('/resgister', [AuthController::class, 'resgister'])->name('auth.resgister');
Route::any('/repass', [AuthController::class, 'repass'])->name('auth.repass');
Route::get('/change-pass/{token}', [AuthController::class, 'change'])->name('auth.change');
Route::post('/change-pass', [AuthController::class, 'changePass'])->name('auth.change-pass');

Route::group(['prefix' => 'admin', 'middleware' => 'login'], function () {
    Route::get("/", [DashBoardController::class, 'index'])->name('admin.index');
    Route::get("/stastics", [StasticController::class, 'index'])->name('stastics');
    //Hotels
    Route::resource('/hotels', HotelController::class);
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/update', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/destroy/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::resource('/hotel_services', HotelServiceController::class);
    Route::resource('/hotel_images', Hotel_ImageController::class);
    Route::resource('/hotel_comments', Hotel_CommentController::class);
    //Tours
    Route::resource('/types', TourTypeController::class);
    Route::put('/type/update', [TourTypeController::class, 'updateType'])->name('type.update');

    Route::resource('/tours', TourController::class);
    // Route::post('/tours-filter', [TourController::class, 'index'])->name('tours.filter');
    // Route::get('/tours-filter', function () {
    //     return redirect(route('tours.index'));
    // });
    Route::post('/tour/add-attributes', [TourController::class, 'addAttributes'])->name('addAttributes.store');
    Route::post('/tour/del-attributes', [TourController::class, 'delAttribute'])->name('delAttribute.destroy');
    Route::post('/tour/add-image', [TourController::class, 'addImage'])->name('addImage.store');
    Route::post('/tour/del-image/{id}', [TourController::class, 'delImage'])->name('delImage.destroy');
    Route::post('/tour/add-hotels', [TourController::class, 'addHotels'])->name('addHotels.store');
    Route::post('/tour/del-hotel', [TourController::class, 'delHotel'])->name('delHotel.destroy');
    Route::post('/tour/add-itinerary', [TourController::class, 'addItinerary'])->name('addItinerary.store');
    Route::post('/tour/update-itinerary', [TourController::class, 'updateItinerary'])->name('updateItinerary.update');
    Route::post('/tour/del-itinerary/{id}', [TourController::class, 'delItinerary'])->name('delItinerary.destroy');
    Route::post('/tour/del-comment/{id}', [TourController::class, 'delComment'])->name('delComment.destroy');
    Route::post('/tour/del-rate/{id}', [TourController::class, 'delRate'])->name('delRate.destroy');
    Route::get('/get-itinerary/{id}', [TourController::class, 'getItinerary']);

    Route::resource('/attributes', AttributeController::class);
    Route::post('/attribute/update', [AttributeController::class, 'update'])->name('attribute.update');
    //Posts
    Route::resource('/posts', PostController::class);
    //Vouchers
    Route::resource('/vouchers', VoucherController::class);
    //Bookings
    Route::any('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    ;
    Route::put('/bookings/update', [BookingController::class, 'update'])->name('bookings.update');
    ;
    Route::get('/bookings/show/{id}', [BookingController::class, 'show'])->name('bookings.show');
    ;
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    ;
    //User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


});
Route::get('/get-stastic/{year}', [StasticController::class, 'indexApi'])->name('stastics.api');
Route::get('/get-provinces', [LocationController::class, 'getProvinces'])->name('provinces');
Route::get('/get-districts/{province_id}', [LocationController::class, 'getDistricts'])->name('districts');
Route::get('/get-wards/{district_id}', [LocationController::class, 'getWards'])->name('wards');
Route::get('/get-hotels/{province_id}', [HotelController::class, 'getHotelByProvince']);






