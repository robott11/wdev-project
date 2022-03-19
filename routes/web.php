<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages;
use App\Http\Controllers\AdminController;

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

Route::get('/', [Pages\HomeController::class, 'index'])->name('home');
Route::get('/sobre', [Pages\AboutController::class, 'index'])->name('about');
Route::get('/depoimentos', [Pages\TestimonyController::class, 'index'])->name('testimony');
Route::post('/depoimentos', [Pages\TestimonyController::class, 'create'])->name('testimony.create');

Route::prefix('/admin')->group(function () {
    Route::middleware(['admin.check'])->group(function() {
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/login', [AdminController::class, 'getLoginPage'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.insert');
        Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    });
});
