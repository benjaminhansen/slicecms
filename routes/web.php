<?php

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

Route::group(['prefix' => 'api'], function(){

});

// backside control area
Route::group(['prefix' => 'control', 'middleware' => 'checkauth'], function(){
    // network admin area
    Route::group(['prefix' => 'network', 'middleware' => 'is_network_admin'], function(){
        Route::get('/', 'Network\\IndexController@index');
        Route::resource('organizations', 'Network\\OrganizationsController');
        Route::resource('users', 'Network\\UsersController');
        Route::resource('themes', 'Network\\ThemesController');
        Route::resource('settings', 'Network\\SettingsController');
    });

    // site members area
    Route::group(['prefix' => 'site', 'middleware' => 'is_site_member'], function(){
        // my sites
        Route::get('/', 'Site\\IndexController@index');

        // site admin area
        Route::group(['prefix' => '{site_id}/admin', 'middleware' => 'is_site_admin'], function(){

        });
    });
});

Route::get('{slug}', 'CMSController@site')->where('slug', '.*');
