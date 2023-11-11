<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class MemberController extends Controller
{
    public function register(Request $request)
    {
        $member = Member::latest()->first() ?? new Member();
        $kode_member = (int) $member->kode_member +1;

        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $kode= $member->kode_member;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $password= Hash::make($input['password']);
        $Members = Member::create([
            'kode_member'=> $kode,
            'nama'=> $request->nama,
            'email'=> $request->email,
            'password'=> $password,
        ]);
        $success =  $Members;
        $success['token'] =  $Members->createToken('MyApp', ['member'])->plainTextToken;
        //kirim email jika sudah sukses daftar atur di app\helpers\Kirimemail.php
       // kirim_email($request->email, $request->name, "Pendaftaran StockMembers", "aktifkan pendaftaran anda disini<a href='https://stockMembers.com/Members/aktifasi/" . $Members->id . "'>Aktifasi Akun</a>", "");
        if ($success) {
            return response()->json([
                'success' => true,
                'code' => 201,
                'message' => 'Register success!',
                'data' => $success,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Register Gagal!'
            ], 401);
        }
    }

    public function aktifasi(Request $request, $id)
    {
        $Members = Member::find($id);
        $Members->aktif = 'Y';
        $Members->update();
        redirect('Members');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        // $password = bcrypt($request['password']);
        $password = Hash::make($request->password);
        if (Auth::guard('member')->attempt( ['email' => $request->email, 'password' => $request->password ])) {

            $Members = Member::select('id_member', 'nama','kode_member', 'email')->find(auth()->guard('member')->user()->id_member);
            $success =  $Members;
            $success['token'] =  $Members->createToken('MyApp', ['member'])->plainTextToken;

            return response()->json([
                'success' => true,
                'code' => 201,
                'message' => 'Login success!',
                'data' => $success,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Login Failed!',
            ], 401);
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        return response()->json([
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ]);
    }
}
