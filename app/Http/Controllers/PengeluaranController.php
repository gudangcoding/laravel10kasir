<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Yajra\DataTables\Facades\DataTables;

class PengeluaranController extends Controller
{
    public function index()
    {
       return view('pengeluaran.index'); 
    }

    public function listData()
    {
    
      $pengeluaran = Pengeluaran::orderBy('id_pengeluaran', 'desc')->get();
      $no = 0;
      $data = array();
      foreach($pengeluaran as $list){
         $no ++;
         $row = array();
         $row[] = $no;
         $row[] = tanggal_indonesia(substr($list->created_at, 0, 10), false);
         $row[] = $list->jenis_pengeluaran;
         $row[] = "Rp. ".format_uang($list->nominal);
         $row[] = '<div class="btn-group">
                    <a onclick="editForm('.$list->id_pengeluaran.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                    <a onclick="deleteData('.$list->id_pengeluaran.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
         $data[] = $row;
      }

      return Datatables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
        $pengeluaran = new Pengeluaran;
        $pengeluaran->jenis_pengeluaran   = $request['jenis'];
        $pengeluaran->nominal = $request['nominal'];
        $pengeluaran->save();
    }

    public function edit($id)
    {
      $pengeluaran = Pengeluaran::find($id);
      echo json_encode($pengeluaran);
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->jenis_pengeluaran   = $request['jenis'];
        $pengeluaran->nominal = $request['nominal'];
        $pengeluaran->update();
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
    }

}
