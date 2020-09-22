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

// Route::get('/', function () 
// {
// 	return redirect('home');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('customers','CustomerController');
Route::resource('towers','TowerController');
Route::resource('pegawais','PegawaiController');
Route::resource('tipe_units','TipeUnitController');
Route::resource('arah_units','ArahUnitController');
Route::resource('chattings','ChattingController');
Route::resource('cicilans','CicilanController');
Route::resource('promosis','PromosiController');
Route::resource('feedbacks','FeedbackController');
Route::resource('gambar_produks','GambarProdukController');
Route::resource('hargajuals','HargaJualController');
Route::resource('lokasis','LokasiController');
Route::resource('pembatalans','PembatalanController');
Route::resource('pembayaran_cicilans','PembayaranCicilanController');
Route::resource('pembayaran_dps','PembayaranDPController');
Route::resource('profils','ProfilController');
Route::resource('spesifikasi_bangunans','SpesifikasiBangunanController');
Route::resource('units','UnitController');
Route::resource('transaksis','TransaksiController');

Route::get('/', 'PengunjungController@index')->name('pengunjung.index');
Route::get('about', 'PengunjungController@about')->name('pengunjung.about');
Route::get('services', 'PengunjungController@services')->name('pengunjung.services');
Route::get('agent', 'PengunjungController@agent')->name('pengunjung.agent');
Route::get('listing', 'PengunjungController@listing')->name('pengunjung.listing');
Route::get('listing/single', 'PengunjungController@listingSingle')->name('pengunjung.listing.single');
Route::get('blog', 'PengunjungController@blog')->name('pengunjung.blog');
Route::get('contact', 'PengunjungController@contact')->name('pengunjung.contact');