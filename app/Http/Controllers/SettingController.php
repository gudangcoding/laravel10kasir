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
      
      //upload logo
      $logo = $request->file('logo')->store('public/images');
      $setting->logo = $logo;  
      //upload kartu
      $kartu_member = $request->file('kartu_member')->store('public/images');
      $setting->kartu_member   = $kartu_member;  
      //save data
      $setting->update();

   //    $request->validate([
   //       'title' => 'required',
   //       'image' => 'required|image|max:2048',
   //   ]);
 
   
   //   $image = new Image([
   //       'title' => $request->get('title'),
   //       'image_path' => $imagePath,
   //   ]);
   //   $image->save();

      //jika file ada
      // if ($request->hasFile('logo')) {
         //ambil nama file
         // $file = $request->file('logo');
         //rubah nama file
         // $logo = $request->file('logo')->store('public/images');
         //tentukan lokasi file
         // $lokasi = public_path('images');
         //upload file dengan nama baru ke lokasi yang sudah ditentikan
         // $file->move($lokasi, $logo);
         // $setting->logo = $logo;  
      // }

      // if ($request->hasFile('kartu_member')) {
         // $kartu_member = $request->file('kartu_member')->store('public/images');
         // $setting->kartu_member   = $kartu_member;  
      // }
      // $setting->update();
      return redirect(route('setting.index'));
   }

}
