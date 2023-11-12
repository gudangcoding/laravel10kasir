<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function index()
    {
        $kategori = Kategori::all();
        return response()->json([
            'success' => true,
            'data' => $kategori
        ], 201);
    }
}
