<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pengeluaran;

use PDF;
// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\PDF;

class LaporanController extends Controller
{
   public function index()
   {
     $awal = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
     $akhir = date('Y-m-d');
     return view('laporan.index', compact('awal', 'akhir')); 
   }

   protected function getData($awal, $akhir){
     $no = 0;
     $data = array();
     $pendapatan = 0;
     $total_pendapatan = 0;
     while(strtotime($awal) <= strtotime($akhir)){
       $tanggal = $awal;
       $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

       $total_penjualan = Penjualan::where('created_at', 'LIKE', "$tanggal%")->sum('bayar');
       $total_pembelian = Pembelian::where('created_at', 'LIKE', "$tanggal%")->sum('bayar');
       $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "$tanggal%")->sum('nominal');

       $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
       $total_pendapatan += $pendapatan;

       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = tanggal_indonesia($tanggal, false);
       $row[] = format_uang($total_penjualan);
       $row[] = format_uang($total_pembelian);
       $row[] = format_uang($total_pengeluaran);
       $row[] = format_uang($pendapatan);
       $data[] = $row;
     }
     $data[] = array("", "", "", "", "Total Pendapatan", format_uang($total_pendapatan));

     return $data;
   }

   public function listData($awal, $akhir)
   {   
     $data = $this->getData($awal, $akhir);

     $output = array("data" => $data);
     return response()->json($output);
   }

   public function refresh(Request $request)
   {
     $awal = $request['awal'];
     $akhir = $request['akhir'];
     return view('laporan.index', compact('awal', 'akhir')); 
   }

   public function exportPDF($awal, $akhir){
     $tanggal_awal = $awal;
     $tanggal_akhir = $akhir;
     $data = $this->getData($awal, $akhir);

     $pdf = PDF::loadView('laporan.pdf', compact('tanggal_awal', 'tanggal_akhir', 'data'));
     $pdf->setPaper('a4', 'potrait');
     
     return $pdf->stream();
    //  return view('laporan.pdf', compact('tanggal_awal', 'tanggal_akhir', 'data')); 
   }
}