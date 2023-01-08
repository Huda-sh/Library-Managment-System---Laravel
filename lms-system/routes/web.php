<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BillController;
use App\Http\Controllers\BillItemController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Foundation\Auth\User;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthenticationController::class)->group(function(){

    Route::get('auth/login', 'login')->name('auth.login');

    Route::get('auth/registration', 'registration')->name('auth.registration');

    Route::get('auth/logout', 'logout')->name('auth.logout');

    Route::post('auth/validate_registration', 'validate_registration')->name('auth.validate_registration');

    Route::post('auth/validate_login', 'validate_login')->name('auth.validate_login');

    Route::get('dashboard', 'dashboard')->name('dashboard');

    Route::get('userdashboard', 'userdashboard')->name('userdashboard');

    Route::get('admindashboard', 'admindashboard')->name('admindashboard');

});

Route::resource('categories',CategoryController::class);

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::get('/books/browseBooks', [BookController::class, 'browseBooks'])->name('books.browseBooks');
Route::get('/books/booksByCategory/{id}', [BookController::class, 'booksByCategory'])->name('books.booksByCategory');
Route::post('/books/addToCart/{id}', [BookController::class, 'addToCart'])->name('books.addToCart');
Route::resource('books',BookController::class);

Route::resource('cartItems',CartItemController::class);

Route::resource('bills',BillController::class);

Route::resource('notifications',NotificationController::class);

Route::get('/rents/rentforuser', [RentController::class, 'rentforuser'])->name('rents.rentforuser');
Route::get('/rents/rentOfUser/{id}', [RentController::class, 'rentOfUser'])->name('rents.rentOfUser');
Route::get('/rents/rentInRange', [RentController::class, 'rentInRange'])->name('rents.rentInRange');
Route::get('/rents/rentInRangeForUser', [RentController::class, 'rentInRangeForUser'])->name('rents.rentInRangeForUser');
Route::get('/rents/createrent', [RentController::class, 'createrent'])->name('rents.createrent');
Route::resource('rents',RentController::class);
Route::post('/rents/restore/{id}', [RentController::class, 'restore'])->name('rents.restore');

Route::get('/users/usersWithMostRents', [UserController::class, 'usersWithMostRents'])->name('users.usersWithMostRents');
Route::resource('users',UserController::class);
