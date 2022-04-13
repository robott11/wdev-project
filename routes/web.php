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
Route::get('/depoimentos', [Pages\TestimonyController::class, 'getTestimonies'])->name('testimony');
Route::post('/depoimentos', [Pages\TestimonyController::class, 'postTestimony'])->name('testimony.create');

Route::prefix('/admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/logout', 'getLogout')->name('admin.logout');
        Route::get('/login', 'getLogin')->name('admin.login');
        Route::post('/login', 'postLogin')->name('admin.login.insert');
        Route::get('/', 'index')->name('admin.home');
        Route::get('/depoimentos', 'getTestimony')->name('admin.testimony');
        Route::get('/depoimentos/{id}/delete', 'getDelete')->name('admin.testimony.del');
        Route::post('/depoimentos/{id}/delete', 'postDelete');
        Route::get('/depoimentos/{id}/edit', 'getEdit')->name('admin.testimony.edit');
        Route::post('/depoimentos/{id}/edit', 'postEdit');
        Route::get('/users', 'getUsers')->name('admin.users');
    });
});
