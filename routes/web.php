<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LikeController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CardCodeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\RaffleDrawController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SocialLoginController;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Route::get('/api/vouchers', [VoucherController::class, 'MerchantIndex']);
// Route::get('/api/merchant/vouchers', [VoucherController::class, 'MerchantIndex']);
// Route::get('/api/order/lists', [OrderController::class, 'Adminindex']);
// Route::get('/api/loyalty-stars/order/{order}/edit', [OrderController::class, 'edit']);
// Route::put('/api/loyalty-stars/order/create', [OrderController::class, 'orderAccept']);
// Route::get('/api/card/lists', [OrderController::class, 'index']);

Route::get('/api/activity-logs', [ActivityLogController::class, 'index']);
Route::get('/api/user/activity-logs', [ActivityLogController::class, 'indexUser']);
// Route::post('/api/voucher/create', [CartController::class, 'store']);
// Route::get('/api/voucher', [CartController::class, 'index']);
// Route::put('/api/voucher/edit/{id}', [CartController::class, 'update']);
// Route::delete('/api/voucher/{id}', [CartController::class, 'destroy']);

 // Merchant Account

Route::get('/api/home/customer/{card_number}/points', [CustomerController::class, 'customerResult']);

// Route::get('/api/stars', [StarController::class, 'index']);


// Route::post('/api/loyalty-stars/crete', [StartPointsController::class, 'store']);
// Route::post('/api/loyalty-stars/crete', [StartPointsController::class, 'update']);
// Route::get('/api/loyalty-stars/{merchant}/edit', [StartPointsController::class, 'edit']);
// Route::put('/api/loyalty-stars/edit', [StartPointsController::class, 'update']);

// Merchant Route
Route::get('/api/merchant/discounts', [DiscountController::class,'index']);

// Route::get('/api/merchant/points', [PointController::class,'merchantIndex']);
// Route::get('/api/merchant/points/{point}/edit', [PointController::class, 'edit']);
// Route::post('/api/merchant/points/{point}/edit', [PointController::class, 'update']);

// Route::post('/api/merchant/points/register', [PointController::class,'store']);

// Admin Route


// User Profile
Route::get('/api/profile', [ProfileController::class, 'index']);
Route::put('/api/user/update-profile', [ProfileController::class, 'updateProfile']);
Route::put('/api/user/update-discount', [ProfileController::class, 'updateDiscount']);
Route::put('/api/user/update-address', [ProfileController::class, 'updateAddress']);
Route::put('/api/user/update-password', [ProfileController::class,'updatePassword']);
// Route::post('/api/user/update-profile', [ProfileController::class, 'uploadImage']);
Route::post('/api/user/upload-logo', [ProfileController::class, 'uploadlogo']);
Route::post('/api/user/upload-background', [ProfileController::class, 'uploadBackground']);
// Route::put('/api/profile-information/edit', [ProfileController::class,'updateProfile']);
// Route::put('/api/profile-business/edit', [ProfileController::class,'updateBusiness']);


// Tripidkard Route
Route::get('/api/tripidkards', [CardCodeController::class, 'index']);
Route::get('/api/merchant/tripidkards', [CardCodeController::class, 'merchantIndex']);

Route::post('/api/tripidkards/create', [CardCodeController::class, 'store']);
Route::get('/api/tripidkards/count', [CardCodeController::class, 'count']);


// Merchant Route
Route::get('/api/merchants', [MerchantController::class, 'index']);
Route::get('/api/merchants-pending', [MerchantController::class, 'indexPending']);
Route::get('/api/merchants-archive', [MerchantController::class, 'indexArchive']);
Route::post('/api/merchants/create', [MerchantController::class, 'store']);
Route::put('/api/merchants/{id}', [MerchantController::class, 'archive']);
Route::get('/api/merchants/{id}/edit', [MerchantController::class, 'edit']);
Route::put('/api/merchants/{merchant}/update', [MerchantController::class, 'update']);
Route::patch('/api/merchant/{id}/status/approve', [MerchantController::class, 'approve']);
Route::patch('/api/merchant/{id}/status/archive', [MerchantController::class, 'archive']);

Route::post('/api/merchant/{id}/increment-views ', [MerchantController::class, 'incrementViews']);
Route::get('/api/merchants/locations', [MerchantController::class, 'searchLocations']);


Route::get('/api/merchants/count', [MerchantController::class, 'count']);


// Customer Route
Route::post('/api/customers/{customer}/edit', [CustomerController::class, 'update']);
Route::get('/api/customers/{customer}/edit', [CustomerController::class, 'edit']);
Route::post('/api/customers/register', [CustomerController::class, 'store']);
Route::get('/api/customers/count', [CustomerController::class, 'count']);

Route::patch('/api/customer/{id}/status/archive', [CustomerController::class, 'archive']);
Route::patch('/api/customer/{id}/status/approve', [CustomerController::class, 'approve']);

Route::get('/api/customers', [CustomerController::class, 'index']);
Route::get('/api/customers/archive', [CustomerController::class, 'indexArchive']);
Route::get('/api/user/customers', [CustomerController::class, 'indexUser']);
Route::get('/api/customer/{id}/points', [CustomerController::class, 'points']);
Route::get('/api/customer/pending', [CustomerController::class, 'indexPending']);


Route::post('/contact/send-email', [EmailController::class, 'sendContactUs']);
Route::post('/api/merchant/stars', [EmailController::class, 'sendStarPoint']);
Route::post('/api/card/orders', [EmailController::class, 'sendCard']);

Route::post('/api/merchant/qrcode', [QrcodeController::class, 'merchantQrCode']);
Route::post('/api/influencer/qrcode', [QrcodeController::class, 'influencerQrCode']);
Route::post('/api/home/qrcode', [QrcodeController::class, 'homeQrCode']);

Route::post('/api/discount/store', [DiscountController::class, 'store']);

Route::post('/api/raffles/create', [RaffleController::class, 'store']);

Route::get('/api/raffles', [RaffleController::class, 'index']);
Route::get('/api/raffles/{id}/edit', [RaffleController::class, 'raffleEdit']);
Route::get('/api/raffles/{id}/show', [RaffleController::class, 'raffleShow']);
Route::post('/api/raffles/join', [RaffleDrawController::class, 'joinRaffle']);
Route::get('/api//api/bookmarks/{id}/participants', [RaffleDrawController::class, 'getRaffleParticipants']);


Route::get('/auth/google', [SocialController::class, 'redirectGoogle'])->name('google-auth');
Route::get('/auth/google-callback', [SocialController::class, 'callbackGoogle/Customer']);

Route::get('/auth/user/google', [SocialLoginController::class, 'redirectGoogle'])->name('google-auth');
Route::get('/auth/google-callback', [SocialLoginController::class, 'callbackGoogleUser']);

Route::get('auth/facebook', action: [SocialController::class, 'redirectFacebook']);
Route::get('auth/user/facebook', [SocialLoginController::class, 'redirectFacebook']);
Route::get('/facebook/callback', [SocialLoginController::class, 'callbackFacebookUser']);


Route::get('auth/facebook', [SocialController::class, 'redirectFacebook']);

// Route to handle the callback from Facebook after authentication
Route::get('/facebook/callback', [SocialController::class, 'callbackFacebook']);


Route::get('/api/merchant/bookmarks', [BookmarkController::class, 'indexMerchant']);
Route::get('/api/bookmarks', [BookmarkController::class, 'index']);
Route::get('/api/bookmarks/count', [BookmarkController::class, 'count']);
Route::post('/api/bookmarks', [BookmarkController::class, 'store']);
Route::delete('/api/bookmarks/{merchant_id}', [BookmarkController::class, 'destroy']);

Route::get('/api/likes', [LikeController::class, 'index']);
Route::get('/api/likes/count', [LikeController::class, 'count']);
Route::post('/api/likes', [LikeController::class, 'store']);
Route::delete('/api/likes/{merchant_id}', [LikeController::class, 'destroy']);

Route::get('{view}', ApplicationController::class)->where('view', '(.*)');

require __DIR__.'/auth.php';
