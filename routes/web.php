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

    });

    // organization admin area
    Route::group(['prefix' => 'organization', 'middleware' => 'is_org_admin'], function(){

    });

    // site members area 
    Route::group(['prefix' => 'site', 'middleware' => 'is_site_member'], function(){
        // site admin area
        Route::group(['prefix' => '{id}/admin', 'middleware' => 'is_site_admin'], function(){
            
        });
    });
});