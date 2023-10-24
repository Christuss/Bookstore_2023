<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::apiResource('/api/copies', CopyController::class);
Route::apiResource('/api/books', BookController::class);
Route::get('/api/lendings', [LendingController::class, 'index']);
Route::get('/api/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'show']);
Route::post('/api/lendings', [LendingController::class, 'store']);

Route::middleware( ['admin'])->group(function () {
    Route::apiResource('/users', UserController::class);
});
Route::patch('/api/update_password/{id}', [UserController::class, 'updatePassword']);

Route::get('/with/book', [BookController::class, 'bookCopy']);
Route::get('/with/filter', [LendingController::class, 'filter']);
Route::get('/with/show_all', [BookController::class, 'showAll']);

require __DIR__.'/auth.php';
