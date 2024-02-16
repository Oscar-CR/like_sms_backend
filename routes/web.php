<?php

use App\Http\Controllers\CsvController;
use App\Http\Controllers\HomeController;
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


Route::get('/', function () {
    return redirect()->route('home.index');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/csv/upload', [CsvController::class, 'store'])->middleware(['auth', 'verified'])->name('csv.upload');
    Route::post('/csv/update', [CsvController::class, 'update'])->middleware(['auth', 'verified'])->name('csv.update');
    Route::post('/csv/delete', [CsvController::class, 'delete'])->middleware(['auth', 'verified'])->name('csv.delete');
    Route::post('/csv/moredata', [CsvController::class, 'moredata'])->middleware(['auth', 'verified'])->name('csv.moredata');

});

require __DIR__.'/auth.php';
