<?php

Route::get('/', ['as' => 'frontBeranda', 'uses' => 'FrontController@getBeranda']);
Route::post('/kontak', ['as' => 'postKontak', 'uses' => 'KontakController@postKontak']);
Route::get('/produk', ['as' => 'frontProduk', 'uses' => 'FrontController@getProduk']);
Route::get('/tentang', ['as' => 'frontTentang', 'uses' => 'FrontController@getTentang']);

Route::get('/test-pdf', ['as' => 'testPDF', 'uses' => 'AdminController@getTestPDF']);

Route::group(['prefix' => 'blog'], function() { 

    Route::get('/', ['as' => 'getBlog', 'uses' => 'BlogController@getBlogHome']);
    Route::get('/berita/{id}', ['as' => 'getBlogDetail', 'uses' => 'BlogController@getBlogDetail']);

});

Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::group(['middleware' => ['redirAdmin']], function(){

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

    // Admin Merk
    Route::get('/merk', ['as' => 'tambahMerk', 'uses' => 'MerkController@getMerk']);
    Route::post('/merk', ['as' => 'tambahMerk', 'uses' => 'MerkController@addMerk']);
    Route::get('/merk/lihat', ['as' => 'lihatMerk', 'uses' => 'MerkController@viewMerk']);
    Route::get('/merk/ubah/{id}', ['as' => 'ubahMerk', 'uses' => 'MerkController@detailMerk']);
    Route::put('/merk/ubah/{id}', ['as' => 'ubahMerk', 'uses' => 'MerkController@ubahMerk']);

    // Admin Distributor
    Route::get('/distributor', ['as' => 'tambahDistributor', 'uses' => 'DistributorController@getDistributor']);
    Route::post('/distributor', ['as' => 'tambahDistributor', 'uses' => 'DistributorController@addDistributor']);
    Route::get('/distributor/lihat', ['as' => 'lihatDistributor', 'uses' => 'DistributorController@viewDistributor']);
    Route::get('/distributor/ubah/{id}', ['as' => 'ubahDistributor', 'uses' => 'DistributorController@detailDistributor']);
    Route::put('/distributor/ubah/{id}', ['as' => 'ubahDistributor', 'uses' => 'DistributorController@ubahDistributor']);
    Route::post('distributor/cari', ['as' => 'cariDistributor', 'uses' => 'DistributorController@searchDistributor']);

    // Admin Pelanggan
    Route::get('/pelanggan', ['as' => 'tambahPelanggan', 'uses' => 'PelangganController@getPelanggan']);
    Route::post('/pelanggan', ['as' => 'tambahPelanggan', 'uses' => 'PelangganController@addPelanggan']);
    Route::get('/pelanggan/lihat', ['as' => 'lihatPelanggan', 'uses' => 'PelangganController@viewPelanggan']);
    Route::get('pelanggan/ubah/{id}', ['as' => 'ubahPelanggan', 'uses' => 'PelangganController@detailPelanggan']);
    Route::put('pelanggan/ubah/{id}', ['as' => 'ubahPelanggan', 'uses' => 'PelangganController@ubahPelanggan']);
    Route::post('pelanggan/cari', ['as' => 'cariPelanggan', 'uses' => 'PelangganController@searchPelanggan']);

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
    Route::get('/masuk/lihat', ['as' => 'lihatMasuk', 'uses' => 'MasukController@viewMasuk']);
    Route::get('/masuk/lihat/{id}', ['as' => 'lihatMasukDetail', 'uses' => 'MasukController@detailMasuk']);
    Route::get('/masuk/hapus/{id}', ['as' => 'hapusMasuk', 'uses' => 'MasukController@reportMasuk']);
    Route::delete('/masuk/hapus/{id}', ['as' => 'hapusMasuk', 'uses' => 'MasukController@deleteMasuk']);
    Route::get('/masuk/pelunasan/{id}', ['as' => 'pelunasanMasuk', 'uses' => 'MasukController@pelunasanMasuk']);
    Route::put('/masuk/pelunasan/{id}', ['as' => 'pelunasanMasuk', 'uses' => 'MasukController@ubahPelunasan']);

    // Admin Barang Keluar
    Route::get('/keluar', ['as' => 'tambahKeluar', 'uses' => 'KeluarController@getKeluar']);
    Route::post('/keluar', ['as' => 'tambahKeluar', 'uses' => 'KeluarController@addKeluar']);
    Route::get('/keluar/lihat', ['as' => 'lihatKeluar', 'uses' => 'KeluarController@viewKeluar']);
    Route::get('/keluar/lihat/{id}', ['as' => 'lihatKeluarDetail', 'uses' => 'KeluarController@detailKeluar']);
    Route::get('/keluar/hapus/{id}', ['as' => 'hapusKeluar', 'uses' => 'KeluarController@reportKeluar']);
    Route::delete('/keluar/hapus/{id}', ['as' => 'hapusKeluar', 'uses' => 'KeluarController@deleteKeluar']);
    Route::get('/keluar/pelunasan/{id}', ['as' => 'pelunasanKeluar', 'uses' => 'KeluarController@pelunasanKeluar']);
    Route::put('/keluar/pelunasan/{id}', ['as' => 'pelunasanKeluar', 'uses' => 'KeluarController@ubahPelunasan']);

    // Admin Laporan
    Route::get('/laporan/barang', ['as' => 'laporanBarang', 'uses' => 'LaporanController@getLaporanBarang']);
    Route::get('/laporan/barang/{tipe}', ['as' => 'laporanExcel', 'uses' => 'LaporanController@exportBarangToPDF']);
    Route::get('/laporan/masuk', ['as' => 'laporanStokMasuk', 'uses' => 'LaporanController@getLaporanStokMasuk']);
    Route::get('/laporan/masuk/{tipe}', ['as' => 'laporanStokMasukExcel', 'uses' => 'LaporanController@exportStokMasukToPDF']);
    Route::get('/laporan/keluar', ['as' => 'laporanStokKeluar', 'uses' => 'LaporanController@getLaporanStokKeluar']);
    Route::get('/laporan/keluar/{tipe}', ['as' => 'laporanStokKeluarExcel', 'uses' => 'LaporanController@exportStokKeluarToPDF']);

    // Admin Front Kontak
    Route::get('/kontak/lihat', ['as' => 'lihatKontak', 'uses' => 'KontakController@viewKontak']);

    // Admin Front Blog
    Route::get('/blog', ['as' => 'tambahBlog', 'uses' => 'BlogController@getAdminBlog']);
    Route::post('/blog', ['as' => 'tambahBlog', 'uses' => 'BlogController@postAdminBlog']);
    Route::get('/blog/lihat', ['as' => 'lihatBlog', 'uses' => 'BlogController@viewAdminBlog']);
});
