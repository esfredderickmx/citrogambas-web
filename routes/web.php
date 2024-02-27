<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DishController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\User\ShowUsers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
return view('welcome');
}); */

Route::view('/', 'index')->name('index');

Route::view('/home', 'index')->name('home');

Route::view('/terms', 'general.terms-conditions')->name('terms');

Route::view('/about', 'general.about-us')->name('about');

Route::view('/faq', 'general.questions')->name('faq');

Route::view('/contact', 'general.contact')->name('contact');

Route::post('/contact', [ContactController::class, 'send']);

Route::get('/login', [AuthenticationController::class, 'form'])->name('auth.form')->middleware('guest');

Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login')->middleware('guest');

Route::post('/register', [AuthenticationController::class, 'register'])->name('auth.register')->middleware('guest');

Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::post('/forgot-password', [AuthenticationController::class, 'forgot'])->name('password.forgot')->middleware('guest');

Route::get('/reset-password/{token}', [AuthenticationController::class, 'reset'])->name('password.reset')->middleware('guest');

Route::post('/reset-password', [AuthenticationController::class, 'update'])->name('password.update');

Route::get('/users', ShowUsers::class)->name('users')->middleware(['auth', 'role:admin,employee']);

Route::post('/user/create', [UserController::class, 'store'])->name('user.store')->middleware(['auth', 'role:admin']);

Route::put('/user/edit/{user}', [UserController::class, 'update'])->name('user.update')->middleware(['auth', 'role:admin,employee']);

Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware(['auth', 'role:admin']);

Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');

Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::put('/profile/change', [ProfileController::class, 'password'])->name('profile.password')->middleware('auth');

Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');

Route::get('/dishes', [DishController::class, 'show'])->name('dishes');

Route::post('/dish/create', [DishController::class, 'store'])->name('dish.store')->middleware(['auth', 'role:admin,employee']);

Route::put('/dish/edit/{dish}', [DishController::class, 'update'])->name('dish.update')->middleware(['auth', 'role:admin,employee']);

Route::delete('/dish/delete/{dish}', [DishController::class, 'destroy'])->name('dish.destroy')->middleware(['auth', 'role:admin']);

Route::get('/reservations', [ReservationController::class, 'show'])->name('reservations')->middleware('auth');

Route::post('/reservation/create', [ReservationController::class, 'store'])->name('reservation.store')->middleware('auth');

Route::put('/reservation/edit/{reservation}', [ReservationController::class, 'update'])->name('reservation.update')->middleware(['auth', 'role:admin,employee']);

Route::delete('/reservation/delete/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy')->middleware('auth');

Route::get('/categories', [CategoryController::class, 'show'])->name('categories')->middleware(['auth', 'role:admin,employee']);

Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store')->middleware(['auth', 'role:admin,employee']);

Route::put('/category/edit/{category}', [CategoryController::class, 'update'])->name('category.update')->middleware(['auth', 'role:admin,employee']);

Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware(['auth', 'role:admin']);

Route::get('/promotions', [PromotionController::class, 'show'])->name('promotions')->middleware(['auth', 'role:admin,employee']);

Route::post('/promotion/create', [PromotionController::class, 'store'])->name('promotion.store')->middleware(['auth', 'role:admin']);

Route::put('/promotion/edit/{promotion}', [PromotionController::class, 'update'])->name('promotion.update')->middleware(['auth', 'role:admin']);

Route::delete('/promotion/delete/{promotion}', [PromotionController::class, 'destroy'])->name('promotion.destroy')->middleware(['auth', 'role:admin']);

Route::get('/tables', [TableController::class, 'show'])->name('tables')->middleware(['auth', 'role:admin,employee']);

Route::post('/table/create', [TableController::class, 'store'])->name('table.store')->middleware(['auth', 'role:admin,employee']);

Route::put('/table/edit/{table}', [TableController::class, 'update'])->name('table.update')->middleware(['auth', 'role:admin,employee']);

Route::delete('/table/delete/{table}', [TableController::class, 'destroy'])->name('table.destroy')->middleware(['auth', 'role:admin']);
