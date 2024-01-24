<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

ROUTE::get('/student/create', [StudentController::class, 'create'])->name('create.student');
ROUTE::post('/student/store', [StudentController::class, 'store'])->name('store.student');
Route::get('edit/{id}', [StudentController::class, 'edit'])->name('edit');
Route::put('{id}', [StudentController::class, 'update'])->name('students.update');
Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('delete/{id}', [StudentController::class, 'delete'])->name('students.delete');