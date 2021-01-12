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

// Route::post('pengunjung/login', 'Auth\LoginPengunjungController@login')->name('pengunjung.login');
Auth::routes();

Route::middleware('auth')->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('customers','CustomerController');
	Route::resource('towers','TowerController');
	Route::get('pegawais/{pegawai}/ubahprofil','PegawaiController@ubahprofil')->name('pegawais.ubahprofil');
	Route::put('pegawais/{pegawai}/simpanprofil','PegawaiController@simpanprofil')->name('pegawais.simpanprofil');
	Route::resource('pegawais','PegawaiController');
	Route::resource('lokasipegawais','LokasiPegawaiController');
	Route::resource('tipe_units','TipeUnitController');
	Route::resource('arah_units','ArahUnitController');
	Route::resource('chattings','ChattingController');
	Route::resource('cicilans','CicilanController');
	Route::resource('promosis','PromosiController');
	Route::resource('feedbacks','FeedbackController');
	Route::resource('gambar_produks','GambarProdukController');
	Route::resource('hargajuals','HargaJualController');
	Route::resource('lokasis','LokasiController');
	Route::resource('pembayaran_cicilans','PembayaranCicilanController');
	Route::resource('pembayaran_dps','PembayaranDPController');
	Route::resource('pembayaran_bookings','PembayaranBookingController');
	Route::resource('profils','ProfilController');
	Route::resource('spesifikasi_bangunans','SpesifikasiBangunanController');
	Route::resource('units','UnitController');
	Route::resource('beritas','BeritaController');

	// verifikasi pembayaran
	Route::put('pembayaran_bookings/{pembayaranBooking}/verifikasi', 'PembayaranBookingController@verifikasi')->name('pembayaran_bookings.verifikasi');
	Route::put('pembayaran_cicilans/{pembayaranCicilan}/verifikasi', 'PembayaranCicilanController@verifikasi')->name('pembayaran_cicilans.verifikasi');
	Route::put('pembayaran_dps/{pembayaranDp}/verifikasi', 'PembayaranDpController@verifikasi')->name('pembayaran_dps.verifikasi');

	Route::put('verifikasis/{verifikasi}/verifikasi','VerifikasiController@verifikasi')->name('verifikasis.verifikasi');
	Route::resource('verifikasis','VerifikasiController');
	Route::get('pembatalans/{pembatalan}/uploadbukti','PembatalanController@uploadBukti')->name('pembatalans.upload');
	Route::put('pembatalans/{pembatalan}/cancel','PembatalanController@cancel')->name('pembatalans.cancel');
	Route::put('pembatalans/{pembatalan}/alasan','PembatalanController@alasan')->name('pembatalans.alasan');
	Route::resource('pembatalans','PembatalanController');
	Route::put('transaksis/{transaksi}/simpanpegawai','TransaksiController@simpanPegawai')->name('transaksis.simpanpegawai');
	Route::get('transaksis/{transaksi}/ubahpegawai','TransaksiController@ubahPegawai')->name('transaksis.pegawai');
	Route::resource('transaksis','TransaksiController');

	Route::get('laporan/penjualan', 'LaporanController@penjualan')->name('laporan.penjualan');
	Route::get('laporan/pembayaran', 'LaporanController@pembayaran')->name('laporan.pembayaran');
	Route::get('laporan/penundaan', 'LaporanController@penundaan')->name('laporan.penundaan');
	Route::get('laporan/pembatalan', 'LaporanController@pembatalan')->name('laporan.pembatalan');
	Route::get('laporan/jatuhtempo', 'LaporanController@jatuhtempo')->name('laporan.jatuhtempo');
	Route::get('laporan/cicilan', 'LaporanController@cicilan')->name('laporan.cicilan');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PengunjungController@index')->name('pengunjung.index');
Route::get('pengunjung/login', 'PengunjungController@login')->name('pengunjung.login');
Route::get('pengunjung/register', 'PengunjungController@register')->name('pengunjung.register');
Route::get('about', 'PengunjungController@about')->name('pengunjung.about');
Route::get('listing', 'PengunjungController@listing')->name('pengunjung.listing');
Route::get('listing/{unit}', 'PengunjungController@listingSingle')->name('pengunjung.listing.single');
Route::get('contact', 'PengunjungController@contact')->name('pengunjung.contact');

Route::get('booking/{unit}', 'PengunjungController@booking')->name('pengunjung.booking');
Route::get('dp/{unit}', 'PengunjungController@dp')->name('pengunjung.dp');
Route::put('simpanjenisbayar/{transaksi}', 'PengunjungController@simpanJenisBayar')->name('pengunjung.simpanjenisbayar');
Route::get('pembatalan/{transaksi}', 'PengunjungController@pembatalan')->name('pengunjung.pembatalan');
Route::get('cicilan/{cicilan}', 'PengunjungController@cicilan')->name('pengunjung.cicilan');
Route::get('cicilan/{pembayaran_cicilan}/bayar', 'PengunjungController@bayarCicilan')->name('pengunjung.bayarcicilan');
Route::put('cicilan/{pembayaran_cicilan}/bayar', 'PengunjungController@simpanCicilan')->name('pengunjung.simpancicilan');
Route::post('feedback', 'PengunjungController@feedback')->name('pengunjung.feedback');
Route::get('map/{lokasi}', 'PengunjungController@map')->name('pengunjung.map');

Route::get('profil', 'PengunjungController@profil')->name('pengunjung.profil');
Route::get('ubahprofil/{customer}', 'PengunjungController@ubahProfil')->name('pengunjung.ubahprofil');
Route::put('simpanprofil/{customer}', 'PengunjungController@simpanProfil')->name('pengunjung.simpanprofil');
Route::get('ubahpassword/{customer}', 'PengunjungController@ubahPassword')->name('pengunjung.ubahpassword');
Route::put('simpanpassword/{customer}', 'PengunjungController@simpanPassword')->name('pengunjung.simpanpassword');
Route::post('chat', 'PengunjungController@chat')->name('pengunjung.chat');
Route::put('bacanotif/{notifikasi}', 'PengunjungController@bacanotif')->name('pengunjung.bacanotif');