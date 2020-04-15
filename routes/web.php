<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::group(['prefix' => 'mdata', 'namespace' => 'MData'], function () {
		Route::group(['prefix' => 'mahasiswa'], function () {
			$ctr = 'MahasiswaController';
            Route::get('/', $ctr . '@show');
            Route::get('add', $ctr . '@add');
            Route::post('create', $ctr . '@create');
            Route::get('{id}/edit', $ctr . '@edit');
            Route::put('{id}/edit', $ctr . '@update');
            Route::get('{id}/destroy', $ctr . '@delete');
        });

        Route::group(['prefix' => 'penerbit'], function () {
			$ctr = 'PenerbitController';
            Route::get('/', $ctr . '@show');
            Route::get('add', $ctr . '@add');
            Route::post('create', $ctr . '@create');
            Route::get('{id}/edit', $ctr . '@edit');
            Route::put('{id}/edit', $ctr . '@update');
            Route::get('{id}/destroy', $ctr . '@delete');
        });

        Route::group(['prefix' => 'buku'], function () {
            $ctr = 'BukuController';
            Route::get('/', $ctr . '@show');
            Route::get('add', $ctr . '@add');
            Route::post('create', $ctr . '@create');
            Route::get('{id}/edit', $ctr . '@edit');
            Route::put('{id}/edit', $ctr . '@update');
            Route::get('{id}/destroy', $ctr . '@delete');
        });

        Route::group(['prefix' => 'parameter'], function () {
            $ctr = 'ParameterController';
            Route::get('{id}', $ctr . '@show');
            Route::put('{id}/edit', $ctr . '@update');
        });
	});

    Route::group(['prefix' => 'operational', 'namespace' => 'Operational'], function () {
        Route::group(['prefix' => 'transaksi'], function () {
            $ctr = 'TransaksiController';
            Route::get('/', $ctr . '@show');
            Route::get('add', $ctr . '@add');
            Route::post('create', $ctr . '@create');
            Route::get('{id}/edit', $ctr . '@edit');
            Route::put('{id}/edit', $ctr . '@update');
            Route::get('{id}/destroy', $ctr . '@delete');
            Route::get('get-mahasiswa', $ctr.'@getMahasiswaData');
            Route::get('get-hari', $ctr.'@getMaxHariPinjam');
        });
    });
});

