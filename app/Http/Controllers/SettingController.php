<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
   public function index()
   {
      return view('setting.index'); 
   }

   public function edit($id)
   {
     $setting = Setting::find($id);
     echo json_encode($setting);
   }

   public function update(Request $request, $id)
   {
      $setting = Setting::find($id);
      $setting->nama_perusahaan   = $request['nama'];
      $setting->alamat         = $request['alamat'];
      $setting->telepon         = $request['telepon'];
      $setting->tipe_nota         = $request['tipe_nota'];
      
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
         $setting->logo = $nama_gambar;  
      }

      if ($request->hasFile('kartu_member')) {
         $file = $request->file('kartu_member');
         $nama_gambar = "card.".$file->getClientOriginalExtension();
         $lokasi = public_path('images');

         $file->move($lokasi, $nama_gambar);
         $setting->kartu_member   = $nama_gambar;  
      }
      $setting->update();
      // return redirect(route('setting.index'));
   }

}
