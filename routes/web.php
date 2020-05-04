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

// Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

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
            Route::post('import-excel', $ctr . '@import');
            Route::get('{id}/edit', $ctr . '@edit');
            Route::put('{id}/edit', $ctr . '@update');
            Route::get('{id}/destroy', $ctr . '@delete');
        });

        Route::group(['prefix' => 'penerbit'], function () {
			$ctr = 'PenerbitController';
            Route::get('/', $ctr . '@show');
            Route::get('add', $ctr . '@add');
            Route::post('create', $ctr . '@create');
            Route::post('import-excel', $ctr . '@import');
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
            Route::get('/show-list-pinjam', $ctr . '@showListPinjam');
            Route::get('{id}/kembali', $ctr . '@kembali');
            Route::put('{id}/kembali', $ctr . '@addKembali');
        });

        Route::group(['prefix' => 'denda'], function () {
            $ctr = 'DendaController';
            Route::get('/', $ctr . '@show');
            Route::get('/all', $ctr . '@showAll');
            Route::get('add', $ctr . '@add');
            Route::post('create', $ctr . '@create');
            Route::get('{id}/bayar', $ctr . '@edit');
            Route::put('{id}/bayar', $ctr . '@update');
        });
    });

    Route::group(['prefix' => 'laporan', 'namespace' => 'Laporan'], function () {
        Route::group(['prefix' => 'peminjaman'], function () {
            $ctr = 'LaporanPeminjamanController';
            Route::get('/', $ctr . '@show');
            Route::post('/report-pdf', $ctr. '@report');
        });

        Route::group(['prefix' => 'pengembalian'], function () {
            $ctr = 'LaporanPengembalianController';
            Route::get('/', $ctr . '@show');
            Route::post('/report-pdf', $ctr. '@report');
        });

        Route::group(['prefix' => 'pinjam-kembali'], function () {
            $ctr = 'LaporanPinjamKembaliController';
            Route::get('/', $ctr . '@show');
            Route::post('/report-pdf', $ctr. '@report');
        });

        Route::group(['prefix' => 'denda'], function () {
            $ctr = 'LaporanDendaController';
            Route::get('/', $ctr . '@show');
            Route::post('/report-pdf', $ctr. '@report');
        });
    });
});

