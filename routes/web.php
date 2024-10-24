<?php

use App\Http\Controllers\ScholarshipController;
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

Route::get('/', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/create/{scholarship_id?}', [ScholarshipController::class, 'create'])->name('scholarships.create');
Route::post('/scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');
Route::get('/scholarships/results', [ScholarshipController::class, 'results'])->name('scholarships.results');
Route::get('/scholarships/check-ipk', [ScholarshipController::class, 'checkIpk']);