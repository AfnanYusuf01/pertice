<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;


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
Route::get('/', [StudentController::class, 'index'])->name('students.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ROUTE::get('/student/create', [StudentController::class, 'create'])->name('create.student');
    ROUTE::post('/student/store', [StudentController::class, 'store'])->name('store.student');
    Route::get('edit/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::get('detail/{id}', [StudentController::class, 'detail'])->name('detail');
    Route::put('{id}', [StudentController::class, 'update'])->name('students.update');
    Route::get('delete/{id}', [StudentController::class, 'delete'])->name('students.delete');
});

require __DIR__.'/auth.php';