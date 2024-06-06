<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\BeauticianController;
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

Route::get('calender', [CalendarController::class, 'index']);
Route::post('store', [CalendarController::class, 'store'])->name('store');



Route::get('beautician', [BeauticianController::class, 'index'])->name('beautician.index');
Route::get('beautician/create', [BeauticianController::class, 'create'])->name('beautician.create');
Route::post('beautician/store', [BeauticianController::class, 'store'])->name('beautician.store');
Route::get('beautician/edit/{id}', [BeauticianController::class, 'edit'])->name('beautician.edit');
Route::post('beautician/update/{id}', [BeauticianController::class, 'update'])->name('beautician.update');
Route::post('beautician/delete/{id}', [BeauticianController::class, 'delete'])->name('beautician.delete');
