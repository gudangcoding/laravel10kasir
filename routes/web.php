<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ImageController;
use App\Models\Kategori;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('penjualan/data', [PenjualanController::class,'listData'])->name('penjualan.data');


Route::controller(ImageController::class)->group(function(){
   Route::get('image-upload', 'index');
   Route::post('image-upload', 'store')->name('image.store');
});

Auth::routes();


Route::group(['middleware' => 'web'], function(){
   Route::get('user/profil', [UserController::class,'profil'])->name('profil');
   Route::patch('user/{id}/change', [UserController::class,'changeProfil'])->name('changeProfil');;

   Route::get('transaksi/baru', [PenjualanDetailController::class,'newSession'])->name('transaksi.new');
   Route::get('transaksi/{id}/data', [PenjualanDetailController::class,'listData'])->name('transaksi.data');
   Route::get('transaksi/cetaknota', [PenjualanDetailController::class,'printNota'])->name('transaksi.cetak');
   Route::get('transaksi/notapdf', [PenjualanDetailController::class,'notaPDF'])->name('transaksi.pdf');
   Route::post('transaksi/simpan', [PenjualanDetailController::class,'store']);
   Route::get('transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class,'loadForm']);
   Route::resource('transaksi', PenjualanDetailController::class);
});

Route::group(['middleware' => ['web', 'cekuser:1' ]], function(){
   Route::get('kategori/data', [KategoriController::class,'listData'])->name('data');
   Route::resource('kategori', KategoriController::class);

   Route::get('produk/data', [ProdukController::class,'listData'])->name('data');
   Route::post('produk/hapus', [ProdukController::class, 'deleteSelected'])->name('deleteSelected');
   Route::post('produk/cetak', [ProdukController::class, 'printBarcode'])->name('printBarcode');
   Route::resource('produk', ProdukController::class);

   Route::get('supplier/data', [SupplierController::class,'listData'])->name('supplier.data');
   Route::resource('supplier', SupplierController::class);

   Route::get('member/data', [MemberController::class,'listData'])->name('member.data');
   Route::post('member/cetak', [MemberController::class,'printCard'])->name('member.printCard');
   Route::resource('member', MemberController::class);

   Route::get('pengeluaran/data', [PengeluaranController::class,'listData'])->name('pengeluaran.data');
   Route::resource('pengeluaran', PengeluaranController::class);


   Route::get('user/data', [UserController::class,'listData'])->name('user.data');
   Route::resource('user', UserController::class);

   Route::get('pembelian/data', [PembelianController::class,'listData'])->name('pembelian.data');
   Route::get('pembelian/{id}/tambah', [PembelianController::class,'create']);
   Route::get('pembelian/{id}/lihat', [PembelianController::class,'show']);
   Route::resource('pembelian', PembelianController::class);   

   Route::get('pembelian_detail/{id}/data', [PembelianDetailController::class,'listData'])->name('pembelian_detail.data');
   Route::get('pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class,'loadForm']);
   Route::resource('pembelian_detail', PembelianDetailController::class);   

   Route::get('penjualan/data', [PenjualanController::class,'listData'])->name('penjualan.data');
   Route::get('penjualan/{id}/lihat', [PenjualanController::class,'show']);
   Route::resource('penjualan', PenjualanController::class);

   Route::get('laporan', [LaporanController::class,'index'])->name('laporan.index');
   Route::post('laporan', [LaporanController::class,'refresh'])->name('laporan.refresh');
   Route::get('laporan/data/{awal}/{akhir}', [LaporanController::class,'listData'])->name('laporan.data'); 
   Route::get('laporan/pdf/{awal}/{akhir}', [LaporanController::class,'exportPDF']);

   Route::resource('setting', SettingController::class);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');





//printBarcode
//contoh
// Route::controller(ItemController::class)->group(function(){

//    Route::get('items', 'index')->name('items.index');

//    Route::post('items', 'store')->name('items.store');

//    Route::get('items/create', 'create')->name('items.create');

//    Route::get('items/{item}', 'show')->name('items.show');

//    Route::put('items/{item}', 'update')->name('items.update');

//    Route::delete('items/{item}', 'destroy')->name('items.destroy');

//    Route::get('items/{item}/edit', 'edit')->name('items.edit');

// });
