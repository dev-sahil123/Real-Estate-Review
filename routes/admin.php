<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;


Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [LoginController::class, 'adminLogin']);
Route::post('logout', [LoginController::class, 'logout']);

Route::middleware(['auth:admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Admin')->group(function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('user', 'UserController@index');    
        
        Route::prefix('property')->group(function() {
            Route::get('index', 'PropertyController@index');

            Route::post('change_status/{id}', 'PropertyController@changeStatus');
            //modals
            Route::get('detail', 'PropertyController@detail');
        });

        Route::prefix('site_setting')->group(function() {
            Route::get('home_page_index', 'SiteSettingController@homePageIndex');
            Route::get('basic_information', 'SiteSettingController@basicInformation');

            Route::post('home_page_store', 'SiteSettingController@homePageStore');
            Route::post('basic_information_store', 'SiteSettingController@basicInformationStore');

            Route::prefix('footer')->group(function() {
                Route::get('index', 'FooterMenuController@index');

                //modal
                Route::get('add', 'FooterMenuController@add');

                Route::post('store', 'FooterMenuController@store');
                Route::post('delete/{id}', 'FooterMenuController@delete');
            });
        });
    });
});
