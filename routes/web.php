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

Route::get('/', function () {
    return view('index');
});


Route::group([
    'namespace'  => 'Blog\Admin',
    'prefix'     => 'admin',
], function () {

    Route::group([
        'middleware' => 'guest',
    ], function () {
        Route::get('login', 'AuthController@getLogin')->name('login');
        Route::post('login', 'AuthController@postLogin');
    });

    Route::group([
        'middleware' => 'auth',
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('index',  'HomeController@index');
        Route::get('',  function () {
            return redirect('admin/index');
        });

        Route::group([
            'prefix' => 'article',
        ], function () {
            Route::get('index',         'ArticleController@index');
            Route::get('create',        'ArticleController@create');
            Route::post('store',        'ArticleController@store');
            Route::get('edit/{id}',     'ArticleController@edit');
            Route::post('update/{id}',  'ArticleController@update');
            Route::post('delete/{id}',  'ArticleController@delete');
        });

        Route::group([
            'prefix' => 'cate',
        ], function () {
            Route::get('index',         'CategoryController@index');
            Route::get('create',        'CategoryController@create');
            Route::post('store',        'CategoryController@store');
            Route::get('edit/{id}',     'CategoryController@edit');
            Route::post('update/{id}',  'CategoryController@update');
            Route::post('delete/{id}',  'CategoryController@delete');
        });

        Route::group([
            'prefix' => 'menu',
        ], function () {
            Route::get('index',         'MenuController@index');
            Route::get('create',        'MenuController@create');
            Route::post('store',        'MenuController@store');
            Route::get('edit/{id}',     'MenuController@edit');
            Route::post('update/{id}',  'MenuController@update');
            Route::post('delete/{id}',  'MenuController@delete');
        });
    });


});

Route::group([
    'namespace' => 'Blog',
    'prefix'    => 'api',
], function () {
    Route::get('menu',       'ApiController@menu');
    Route::get('lists',      'ApiController@lists');
    Route::get('show',       'ApiController@show');
    Route::get('recommend',  'ApiController@recommend');
    Route::get('popularity', 'ApiController@popularity');
    Route::get('tags',       'ApiController@tags');
    Route::get('links',      'ApiController@links');
    Route::post('vote',      'ApiController@vote');
});