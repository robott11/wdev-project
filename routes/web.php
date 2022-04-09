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
        Route::get('/logout', 'logout')->name('admin.logout');
        Route::get('/login', 'getLoginPage')->name('admin.login');
        Route::post('/login', 'login')->name('admin.login.insert');
        Route::get('/', 'index')->name('admin.home');
        Route::get('/depoimentos', 'getTestimonyPage')->name('admin.testimony');
        Route::get('/depoimentos/{id}/delete', 'getDeleteTestimonyPage')->name('admin.testimony.del');
        Route::post('/depoimentos/{id}/delete', 'deleteTestimony');
        Route::get('/depoimentos/{id}/edit', 'getEditTestimonyPage')->name('admin.testimony.edit');
        Route::post('/depoimentos/{id}/edit', 'editTestimony');
        Route::get('/users', 'getUsersPage')->name('admin.users');
    });
});
