<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Setting;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Member;
use App\Models\Penjualan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $setting = Setting::find(1);

    //   $awal = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
    //   $akhir = date('Y-m-d');

    //   $tanggal = $awal;
    //   $data_tanggal = array();
    //   $data_pendapatan = array();

    //   while(strtotime($tanggal) <= strtotime($akhir)){ 
    //     $data_tanggal[] = (int)substr($tanggal,8,2);
        
    //     $pendapatan = Penjualan::where('created_at', 'LIKE', "$tanggal%")->sum('bayar');
    //     $data_pendapatan[] = (int) $pendapatan;

    //     $tanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
    //   }
        
    //     $kategori = Kategori::count();
    //     $produk = Produk::count();
    //     $supplier = Supplier::count();
    //     $member = Member::count();

    //     if(Auth::user()->level == 1) return view('home.admin', compact('kategori', 'produk', 'supplier', 'member', 'awal', 'akhir', 'data_pendapatan', 'data_tanggal'));
    //     else return view('home.kasir', compact('setting'));
    // }

    public function index()
{
    $setting = Setting::find(1);

    $now = now(); // Waktu saat ini
    $awalBulanIni = $now->startOfMonth(); // Awal bulan ini
    $akhirBulanIni = $now->endOfMonth(); // Akhir bulan ini

    $tanggal = $awalBulanIni;
    $data_tanggal = array();
    $data_pendapatan = array();

    while ($tanggal <= $akhirBulanIni) {
        $data_tanggal[] = (int)$tanggal->format('d');

        $pendapatan = Penjualan::whereBetween('created_at', [$tanggal->startOfDay(), $tanggal->endOfDay()])->sum('bayar');
        $data_pendapatan[] = (int)$pendapatan;

        $tanggal->addDay();
    }

    $kategori = Kategori::count();
    $produk = Produk::count();
    $supplier = Supplier::count();
    $member = Member::count();

    if (Auth::user()->level == 1) {
        return view('home.admin', compact('kategori', 'produk', 'supplier', 'member', 'awalBulanIni', 'akhirBulanIni', 'data_pendapatan', 'data_tanggal'));
    } else {
        return view('home.kasir', compact('setting'));
    }
}

}
