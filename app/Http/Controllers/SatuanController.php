<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\satuan;

class satuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('satuan.index');
    }

    public function data()
    {
        $satuan = Satuan::orderBy('id_satuan', 'desc')->get();

        return datatables()
            ->of($satuan)
            ->addIndexColumn()
           
            ->addColumn('aksi', function ($satuan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('satuan.edit', $satuan->id_satuan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('satuan.destroy', $satuan->id_satuan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
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
        $satuan = new satuan();
        $satuan->nama_satuan = $request->nama_satuan;
        
        $satuan->save();
        return redirect('satuan');
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
        $satuan = Satuan::find($id);

        return response()->json($satuan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $satuan = Satuan::find($id);
        return response()->json($satuan);
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
        $satuan = Satuan::find($id);
        $satuan->nama_satuan = $request->nama_satuan;
        
        $satuan->update();
        return redirect('satuan');
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
        $satuan = Satuan::find($id);
        $satuan->delete();
        return redirect('satuan');
        //return response(null, 204);
    }
}
