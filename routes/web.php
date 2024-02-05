<?php

use App\Http\Controllers\admin\{FoodController, GuestController, RoomController, RoomTypeController, UserController};
use App\Http\Controllers\ProfileController;
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
Route::get('/test', function(){
    return view('app');
});

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/welcome', function() {
    return view('welcome');
});


Route::get('/', function () {
    return view('admin.layouts.master');
})->middleware(['auth','verified'])->name('master');

Route::middleware('auth','role:admin')->prefix('admin')->group(function(){


    ## user
    Route::resource('users', UserController::class);

    ## room type
    Route::resource('roomTypes', RoomTypeController::class)->middleware('can:room types');
    Route::get('search-room-types', [RoomTypeController::class, 'search']);
    Route::get('roomTypes/status/{id}', [RoomTypeController::class, 'change_status']);


    ## room
    Route::resource('rooms', RoomController::class);
    Route::get('search-rooms', [RoomController::class, 'search']);
    Route::get('rooms/status/{id}', [RoomController::class, 'change_status']);

    ## guest
    Route::resource('guests', GuestController::class);
    Route::get('search-guests', [GuestController::class, 'search']);

    ## food
    Route::resource('foods', FoodController::class);
    Route::get('search-foods', [FoodController::class, 'search']);
    Route::get('foods/status/{id}', [FoodController::class, 'change_status']);
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
