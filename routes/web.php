<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::group(['middleware' => ['redirAdmin']], function(){
    // Root Redirect
    Route::get('/', function(){
        return redirect()->route('login');
    });
    // Login
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
    Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function(){
    // Root Redirect
    Route::get('/', function(){
        return redirect()->route('admin');
    });
    // Admin Home
    Route::get('/home', ['as' => 'admin', 'uses' => 'AdminController@getHome']);

    // Admin Kategori
    Route::get('/kategori', ['as' => 'tambahKategori', 'uses' => 'KategoriController@getKategori']);
    Route::post('/kategori', ['as' => 'tambahKategori', 'uses' => 'KategoriController@addKategori']);
    Route::get('/kategori/lihat', ['as' => 'lihatKategori', 'uses' => 'KategoriController@viewKategori']);
    Route::get('/kategori/ubah/{id}', ['as' => 'ubahKategori', 'uses' => 'KategoriController@detailKategori']);
    Route::put('/kategori/ubah/{id}', ['as' => 'ubahKategori', 'uses' => 'KategoriController@editKategori']);
    Route::get('/kategori/hapus/{id}', ['as' => 'hapusKategori', 'uses' => 'KategoriController@reportKategori']);
    Route::delete('/kategori/hapus/{id}', ['as' => 'hapusKategori', 'uses' => 'KategoriController@deleteKategori']);

    // Admin Satuan
    Route::get('/satuan', ['as' => 'tambahSatuan', 'uses' => 'SatuanController@getSatuan']);
    Route::post('/satuan', ['as' => 'tambahSatuan', 'uses' => 'SatuanController@addSatuan']);
    Route::get('/satuan/lihat', ['as' => 'lihatSatuan', 'uses' => 'SatuanController@viewSatuan']);
    Route::get('/satuan/ubah/{id}', ['as' => 'ubahSatuan', 'uses' => 'SatuanController@detailSatuan']);
    Route::put('/satuan/ubah/{id}', ['as' => 'ubahSatuan', 'uses' => 'SatuanController@editSatuan']);
    Route::get('/satuan/hapus/{id}', ['as' => 'hapusSatuan', 'uses' => 'SatuanController@reportSatuan']);
    Route::delete('/satuan/hapus/{id}', ['as' => 'hapusSatuan', 'uses' => 'SatuanController@deleteSatuan']);

    // Admin Barang
    Route::get('/barang', ['as' => 'tambahBarang', 'uses' => 'BarangController@getBarang']);
    Route::post('/barang', ['as' => 'tambahBarang', 'uses' => 'BarangController@addBarang']);
    Route::get('/barang/lihat', ['as' => 'lihatBarang', 'uses' => 'BarangController@viewBarang']);
    Route::get('/barang/ubah/{id}', ['as' => 'ubahBarang', 'uses' => 'BarangController@detailBarang']);
    Route::put('/barang/ubah/{id}', ['as' => 'ubahBarang', 'uses' => 'BarangController@editBarang']);
    Route::get('/barang/hapus/{id}', ['as' => 'hapusBarang', 'uses' => 'BarangController@reportBarang']);
    Route::delete('/barang/hapus/{id}', ['as' => 'hapusBarang', 'uses' => 'BarangController@deleteBarang']);
    Route::post('/barang/cari', ['as' => 'cariBarang', 'uses' => 'BarangController@searchBarang']);
    Route::get('/barang/stok/{id}', ['as' => 'stokBarang', 'uses' => 'BarangController@getStokBarang']);

    // Admin Barang Masuk
    Route::get('/masuk', ['as' => 'tambahMasuk', 'uses' => 'MasukController@getMasuk']);
    Route::post('/masuk', ['as' => 'tambahMasuk', 'uses' => 'MasukController@addMasuk']);
});
