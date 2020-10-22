<?php

use App\Exports\BooksExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Auth::routes([
    'register' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

//USERS
Route::resource('user', 'UserController');

//MEMBERS
Route::get('member/guru', 'MemberController@memberGuru');
Route::get('member/siswa', 'MemberController@memberSiswa');
Route::resource('member', 'MemberController');
Route::get('memberReport', 'MemberController@memberReport');

//BOOKS
Route::resource('book', 'BookController');
Route::get('bookReport', 'BookController@bookReport');

//CATEGORY
Route::resource('category', 'CategoryController');

//VISITORS
Route::resource('visitor', 'VisitorController');
Route::get('visitor.search', 'VisitorController@search');
Route::get('visitorReport', 'VisitorController@visitorReport');

//TRANSACTIONS
Route::resource('transaction', 'TransactionController');
Route::get('transactionReport', 'TransactionController@transactionReport');
Route::get('transactionDenda', 'TransactionController@transactionDenda');

//DENDA
Route::get('denda/{id}', 'TransactionController@denda');
Route::PUT('bayarDenda/{id}', 'TransactionController@bayarDenda');

//IMPORT
Route::post('/member/import_excel', 'MemberController@import');
Route::post('/book/import_excel', 'BookController@import');

//CARD
Route::resource('card', 'CardController');

//PENCARIAN
Route::get('/pencarian', 'PencarianController@index');
Route::get('/pencarian/cari', 'PencarianController@cari');

//LAPORAN
Route::get('/cetakTransaksi', 'LaporanController@cetakTransaksi');
Route::get('/laporanTransaksi', 'LaporanController@laporanTransaksi');
Route::get('/laporanTransaksi/pdf', 'LaporanController@transaksiPdf');
Route::get('/cetakBuku', 'LaporanController@cetakBuku');
Route::get('/laporanBuku', 'LaporanController@laporanBuku');
Route::get('/laporanBuku/pdf', 'LaporanController@bukuPdf');
Route::get('/cetakAnggota', 'LaporanController@cetakAnggota');
Route::get('/laporanAnggota', 'LaporanController@laporanAnggota');
Route::get('/laporanAnggota/pdf', 'LaporanController@anggotaPdf');
Route::get('/cetakPengunjung', 'LaporanController@cetakPengunjung');
Route::get('/laporanPengunjung', 'LaporanController@laporanPengunjung');
Route::get('/laporanPengunjung/pdf', 'LaporanController@pengunjungPdf');

// Excel
Route::get('/xls', function () {
    return Excel::download(new BooksExport, 'books.xlsx');
});

Route::get('/cetak', 'PdfController@cetak');
Route::get('/pdf', 'PdfController@index');
Route::get('/pdf/cetak_pdf', 'PdfController@cetak_pdf');

Route::get('barcode', function () {
    return view('layouts.barcode');
});
