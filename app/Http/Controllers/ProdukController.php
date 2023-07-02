<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;
use PDF;
// use Barryvdh\DomPDF\PDF;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Produk::select('*');
            $data = Produk::leftJoin('kategoris', 'kategoris.id_kategori', '=', 'produks.id_kategori')
            ->orderBy('produks.id_produk', 'desc')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function ($item) {
                        $cek = "<input type='checkbox' name='id[]'' value='".$item->id_produk."'>";
                        return $cek;
                      })
                    ->addColumn('nomor', function ($item) {
                        return $item->id_produk;
                      })
                    ->addColumn('action', function($row){
                     $btn = '<div class="btn-group">
                     <a onclick="editForm('.$row->id_produk.')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                     <a onclick="deleteData('.$row->id_produk.')" class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
                  return $btn;
                    })
                    ->rawColumns(['checkbox','nomor','action'])
                    ->make(true);
        }
       $kategori = Kategori::all();      
       return view('produk.index', compact('kategori'));
    }

    public function listData()
    {
    
      $produk = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
      ->orderBy('produk.id_produk', 'desc')
      ->get();
        $no = 0;
        $data = array();
        foreach($produk as $list){
          $no ++;
          $row = array();
          $row[] = "<input type='checkbox' name='id[]'' value='".$list->id_produk."'>";
          $row[] = $no;
          $row[] = $list->kode_produk;
          $row[] = $list->nama_produk;
          $row[] = $list->nama_kategori;
          $row[] = $list->merk;
          $row[] = "Rp. ".format_uang($list->harga_beli);
          $row[] = "Rp. ".format_uang($list->harga_jual);
          $row[] = $list->diskon."%";
          $row[] = $list->stok;
          $row[] = "<div class='btn-group'>
                   <a onclick='editForm(".$list->id_produk.")' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i></a>
                  <a onclick='deleteData(".$list->id_produk.")' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></div>";
          $data[] = $row;
        }
        
        return Datatables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {

        $jml = Produk::where('kode_produk', '=', $request['kode'])->count();
        if($jml < 1){
            $produk = new Produk;
            $produk->kode_produk     = $request['kode'];
            $produk->nama_produk    = $request['nama'];
            $produk->id_kategori    = $request['kategori'];
            $produk->merk          = $request['merk'];
            $produk->harga_beli      = $request['harga_beli'];
            $produk->diskon       = $request['diskon'];
            $produk->harga_jual    = $request['harga_jual'];
            $produk->stok          = $request['stok'];

            //jika file ada
            if ($request->hasFile('logo')) {
                //ambil nama file
                $file = $request->file('logo');
                //rubah nama file
                $nama_gambar = "logo.".$file->getClientOriginalExtension();
                //tentukan lokasi file
                $lokasi = public_path('images');
                //upload file dengan nama baru ke lokasi yang sudah ditentikan
                $file->move($lokasi, $nama_gambar);
                $produk->logo = $nama_gambar;  
            }

            // if($request->file('image')){
            //     $file= $request->file('image');
            //     $filename= date('YmdHi').$file->getClientOriginalName();
            //     $file-> move(public_path('public/Image'), $filename);
            //     $produk->gambar= $filename;
            // }
            $produk->save();
            echo json_encode(array('msg'=>'success'));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function edit($id)
    {
      $produk = Produk::find($id);
      echo json_encode($produk);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->nama_produk    = $request['nama'];
        $produk->id_kategori    = $request['kategori'];
        $produk->merk          = $request['merk'];
        $produk->harga_beli      = $request['harga_beli'];
        $produk->diskon       = $request['diskon'];
        $produk->harga_jual    = $request['harga_jual'];
        $produk->stok          = $request['stok'];
        $produk->update();
        echo json_encode(array('msg'=>'success'));
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
    }

    public function deleteSelected(Request $request)
    {
        foreach($request['id'] as $id){
            $produk = Produk::find($id);
            $produk->delete();
        }
    }

    public function printBarcode(Request $request)
    {
        $dataproduk = array();
        foreach($request['id'] as $id){
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }
        $no = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');      
        return $pdf->stream();
    }

    public function show(Request $request)
    {
        $dataproduk = array();
        foreach($request['id'] as $id){
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }
        $no = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');      
        return $pdf->stream();
    }
}
