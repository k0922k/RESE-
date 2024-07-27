<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoneController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\QrCodeValidationController;

Route::get('/', [ShopController::class, 'shop_all'])->name('shop_all');
Route::get('/common', [ShopController::class, 'showCommon'])->name('common');
Route::get('/menu1', [ShopController::class, 'showMenu1'])->name('menu1');
Route::get('/menu2', [ShopController::class, 'showMenu2'])->name('menu2');
Route::get('/search', [ShopController::class, 'search'])->name('search');
Route::get('/shops/create', [ShopController::class, 'create'])->name('shop.create');
Route::post('/shops', [ShopController::class, 'store'])->name('shop.store');
Route::get('/shops/{shop_id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/detail/{shop_id}', [ShopController::class, 'showDetail'])->name('shop.detail');
Route::post('/shops/{shop_id}/favorite', [ShopController::class, 'toggleFavorite'])->name('shop.favorite')->middleware('auth');
Route::post('/shops/{shop_id}/reserve', [ShopController::class, 'reserve'])->name('shop.reserve')->middleware('auth');
Route::get('/done', [DoneController::class, 'done'])->name('done');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/thanks', [RegisterController::class, 'thanks'])->name('thanks');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage')->middleware('auth');
Route::delete('/reservation/{reservation_id}/cancel', [UserController::class, 'cancelReservation'])->name('reservation.cancel');
Route::delete('/shop/{shop_id}/favorite', [UserController::class, 'toggleFavorite'])->name('shop.favorite.toggle');
Route::get('/user-roles/{id}', [UserController::class, 'showRoles']);

Route::post('/reviews/{reservation_id}', [ReviewController::class, 'store'])->name('review.store');
Route::get('/generate-qr-code/{reservationId}', [QrCodeController::class, 'generate'])->name('generate.qr_code')->middleware('auth');
Route::post('/validate-qr-code', [QrCodeValidationController::class, 'validateQrCode'])->name('validate_qr_code')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::put('/reservation/{reservation_id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('/reservation/{reservation_id}', [ReservationController::class, 'cancel'])->name('reservation.cancel.admin');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/store-representatives', [AdminController::class, 'index'])->name('admin.store_representatives');
    Route::get('/admin/store-representatives/list', [AdminController::class, 'list'])->name('admin.store_representatives.list');
    Route::get('/admin/store-representatives/create', [AdminController::class, 'create'])->name('admin.store_representatives.create');
    Route::post('/admin/store-representatives', [AdminController::class, 'store'])->name('admin.store_representatives.store');
    Route::put('/admin/store-representatives/{id}/edit', [AdminController::class, 'edit'])->name('admin.store_representatives.edit');
    Route::put('/admin/store-representatives/{id}', [AdminController::class, 'update'])->name('admin.store_representatives.update');
    Route::delete('/admin/store_representatives/{id}', [AdminController::class, 'destroy'])->name('admin.store_representatives.destroy');
    Route::post('/admin/send-notification', [AdminController::class, 'sendNotification'])->name('admin.sendNotification');
    Route::get('/admin/send-notification', [AdminController::class, 'showSendNotificationForm'])->name('admin.sendNotificationForm');
});

