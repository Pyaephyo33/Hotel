<?php

use App\Http\Controllers\admin\{RoomController, RoomTypeController};
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


Route::get('/', function () {
    return view('admin.layouts.master');
})->middleware(['auth','verified'])->name('master');

Route::middleware('auth')->prefix('admin')->group(function(){

    ## room type
    Route::resource('roomTypes', RoomTypeController::class);
    Route::get('search-room-types', [RoomTypeController::class, 'search']);
    Route::get('roomTypes/status/{id}', [RoomTypeController::class, 'change_status']);


    ## room
    Route::resource('rooms', RoomController::class);
    Route::get('search-rooms', [RoomController::class, 'search']);
    Route::get('rooms/status/{id}', [RoomController::class, 'change_status']);
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
