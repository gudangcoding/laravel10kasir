<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Satuan.index');
    }

    public function data()
    {
        $Satuan = Satuan::orderBy('id_Satuan', 'desc')->get();

        return datatables()
            ->of($Satuan)
            ->addIndexColumn()
            ->addColumn('gambar', function ($gbr) {
                $gambar = isset($gbr->gambar) ? asset("images/Satuan/" . $gbr->gambar) : asset("no-image.jpg");
                return '<img width="50" src="' . $gambar . '">';
            })
            ->addColumn('aksi', function ($Satuan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('Satuan.update', $Satuan->id_Satuan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('Satuan.destroy', $Satuan->id_Satuan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'gambar'])
            ->make(true);
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
        $Satuan = new Satuan();
        $Satuan->nama_satuan = $request->nama_satuan;
        if ($request->hasFile('gambar')) {
            $imageName = "Satuan - " . time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/Satuan'), $imageName);
            $Satuan->gambar   = $imageName;
            $Satuan->save();
        }
        $Satuan->save();
        return redirect('Satuan');
        //return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Satuan = Satuan::find($id);

        return response()->json($Satuan);
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
        $Satuan = Satuan::find($id);
        $Satuan->nama_satuan = $request->nama_satuan;
        if ($request->hasFile('gambar')) {
            $imageName = "Satuan - " . time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/Satuan'), $imageName);
            $Satuan->gambar   = $imageName;
            $Satuan->save();
        }
        $Satuan->update();
        return redirect('Satuan');
        //return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Satuan = Satuan::find($id);
        $Satuan->delete();
        return redirect('Satuan');
        //return response(null, 204);
    }
}
