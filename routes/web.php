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

Route::get('pass', function(){
    return bcrypt('Bhanse057994');
});

Route::resource('login', 'AuthController');
Route::get('logout', 'AuthController@logout');

// backside control area
Route::group(['middleware' => 'checkauth'], function(){
    Route::group(['prefix' => 'api/v1'], function(){
        Route::get('current-user', 'Slice\\Api\\ApiController@current_user');
        Route::post('edit-current-user', 'Slice\\Api\\ApiController@edit_current_user');
    });

    Route::group(['prefix' => 'control'], function(){
        Route::get('/', 'Slice\\ControlController@index');
        Route::get('profile', 'Slice\\ProfileController@index');

        // network admin area
        Route::group(['prefix' => 'network', 'middleware' => 'is_network_admin'], function(){
            Route::get('/', 'Slice\\Network\\IndexController@index');
            Route::resource('organizations', 'Slice\\Network\\OrganizationsController');
            Route::resource('users', 'Slice\\Network\\UsersController');
            Route::resource('themes', 'Slice\\Network\\ThemesController');
            Route::resource('settings', 'Slice\\Network\\SettingsController');
        });

        // site members area
        Route::group(['prefix' => 'site', 'middleware' => 'is_site_member'], function(){
            // my sites
            Route::get('/', 'Slice\\Site\\IndexController@index');

            // site admin area
            Route::group(['prefix' => '{site_id}/admin', 'middleware' => 'is_site_admin'], function(){

            });
        });
    });
});

Route::get('{slug}', 'CMSController@site')->where('slug', '.*');
