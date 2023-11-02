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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $Members = Member::create($input);
        $success =  $Members;
        $success['token'] =  $Members->createToken('MyApp', ['Members'])->plainTextToken;
        //kirim email jika sudah sukses daftar atur di app\helpers\Kirimemail.php
        kirim_email($request->email, $request->name, "Pendaftaran StockMembers", "aktifkan pendaftaran anda disini<a href='https://stockMembers.com/Members/aktifasi/" . $Members->id . "'>Aktifasi Akun</a>", "");
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

        if (Auth::guard('Members')->attempt(['email' => $request->email, 'password' => $request->password])) {

            $Members = Member::select('id', 'name', 'email')->find(auth()->guard('Members')->user()->id);
            $success =  $Members;
            $success['token'] =  $Members->createToken('MyApp', ['Members'])->plainTextToken;

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
        Auth::guard('Members')->logout();
        return response()->json([
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ]);
    }
}
