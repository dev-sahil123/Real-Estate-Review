<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('admin', function () {
	return redirect('admin/login');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('property/index', [App\Http\Controllers\PropertyController::class, 'index']);

Route::post('user_login', [LoginController::class, 'authenticate'])->name('login');
Route::get('documents/properties/{file}')->middleware('auth.access');

Route::group(['prefix' => 'property'], function() {
    Route::get('detail/{slug}', [App\Http\Controllers\PropertyController::class, 'detail']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('image_upload', [App\Http\Controllers\ImageUploadController::class, 'upload']);
    Route::post('file_upload', [App\Http\Controllers\DocumentUploadController::class, 'upload']);
    Route::post('image_delete', [App\Http\Controllers\ImageUploadController::class, 'delete']);
    Route::post('file_delete', [App\Http\Controllers\DocumentUploadController::class, 'delete']);

    Route::namespace('App\Http\Controllers')->prefix('write_a_review')->group(function() {
        Route::get('step1', 'PropertyReviewController@step1');
        Route::get('step2', 'PropertyReviewController@step2');
        Route::get('step3', 'PropertyReviewController@step3');

        Route::post('store_step1', 'PropertyReviewController@storeStep1');
        Route::post('store_step2', 'PropertyReviewController@storeStep2');
        Route::post('store_step3', 'PropertyReviewController@storeStep3');
    });
    
	Route::group(['prefix' => 'account'], function() {
        Route::get('dashboard', [App\Http\Controllers\Account\DashboardController::class, 'index']);
        Route::post('profile/update', [App\Http\Controllers\Account\ProfileController::class, 'update'])->name('profile.update');
        
        Route::namespace('App\Http\Controllers\Account')->prefix('property')->group(function() {
            Route::get('add', 'PropertyController@edit');
            Route::get('edit', 'PropertyController@edit');
            
            Route::post('store', 'PropertyController@store');
            Route::post('add_favorite', 'PropertyController@addFavorite');
        });
    });
    
    Route::post('profile/edit', [App\Http\Controllers\Account\UserController::class, 'profile']);
});