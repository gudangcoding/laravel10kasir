<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Satuan;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::leftJoin(
            'kategori', 
            'kategori.id_kategori', 'produk.id_kategori')
            ->select('produk.*', 'nama_kategori')
            ->orderBy('kode_produk', 'asc')
            ->get();

        return response()->json([
            'data'=> $produk,
            'success'=>true
        ],201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = Produk::latest()->first() ?? new Produk();
        $kode = $request['kode_produk'] = 'P' . tambah_nol_didepan((int)$produk->id_produk + 1, 6);

        $produk = new Produk;
        $produk->kode_produk     = $kode;
        $produk->nama_produk    = $request['nama_produk'];
        $produk->id_kategori    = $request['id_kategori'];
        $produk->merk          = $request['merk'];
        $produk->harga_beli      = $request['harga_beli'];
        $produk->diskon       = $request['diskon'];
        $produk->harga_jual    = $request['harga_jual'];
        $produk->stok          = $request['stok'];
        $produk->id_satuan          = $request['satuan'];
        $produk->stok_minimal          = $request['stok_minimal'];
        //  //upload gambar
        if ($request->hasFile('gambar')) {
            $imageName = "Produk - " . time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/produk'), $imageName);
            $produk->gambar   = $imageName;
            $produk->save();
        }
        $produk->save();
        return redirect('produk');
        // return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->nama_produk    = $request['nama_produk'];
        $produk->id_kategori    = $request['id_kategori'];
        $produk->merk          = $request['merk'];
        $produk->harga_beli      = $request['harga_beli'];
        $produk->diskon       = $request['diskon'];
        $produk->harga_jual    = $request['harga_jual'];
        $produk->stok          = $request['stok'];
        $produk->id_satuan          = $request['satuan'];
        $produk->stok_minimal          = $request['stok_minimal'];
        //  //upload gambar
        if ($request->hasFile('gambar')) {
            $imageName = "Produk - " . time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/produk'), $imageName);
            $produk->gambar   = $imageName;
            $produk->save();
        }
        $produk->update();

        return redirect('produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }

        $no  = 1;
        $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
    }
}
