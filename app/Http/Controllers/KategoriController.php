<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
   public function index(Request $request)
   {
      if ($request->ajax()) {
         $data = Kategori::select('*');
         return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                  $btn = '<div class="btn-group">
                  <a onclick="editForm('.$row->id_kategori.')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                  <a onclick="deleteData('.$row->id_kategori.')" class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
               return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
     }
   //   $segment = ucwords($request->segment(1));
     //dd($segment);
      // return view('kategori.index', compact('segment'));
      return view('kategori.index');
   }

   public function data()
   {
   
     $kategori = Kategori::orderBy('id_kategori', 'desc')->get();
     $no = 0;
     $data = array();
     foreach($kategori as $list){
       $no ++;
       $row = array();
       $row[] = $no;
       $row[] = $list->nama_kategori;
       $row[] = '<div class="btn-group">
               <a onclick="editForm('.$list->id_kategori.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
               <a onclick="deleteData('.$list->id_kategori.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
       $data[] = $row;
     }

     $output = array("data" => $data);
     return response()->json($output);
   }

   public function store(Request $request)
   {
      $kategori = new Kategori;
      $kategori->nama_kategori = $request['nama'];
      $kategori->save();

      // $request->validate([
      //    'name' => 'required',
      //    'email' => 'required',
      //    'address' => 'required'
      //    ]);
      //    $company = new Company;
      //    $company->name = $request->name;
      //    $company->email = $request->email;
      //    $company->address = $request->address;
      //    $company->save();
      //    return redirect()->route('companies.index')
      //    ->with('success','Company has been created successfully.');
      //    }
   }

   public function edit($id)
   {
     $kategori = Kategori::find($id);
     echo json_encode($kategori);
   }

   public function update(Request $request, $id)
   {
      $kategori = Kategori::find($id);
      $kategori->nama_kategori = $request['nama'];
      $kategori->update();
   }

   public function destroy($id)
   {
      $kategori = Kategori::find($id);
      $kategori->delete();
   }

   // public function destroy(Request $request)
   // {
   //    $com = Kategori::where('id',$request->id)->delete();
   //    return Response()->json($com);
   // }
}
