<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    //
    public function index(): View
    {
        return view('imageUpload');
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
          
        $imageName = time().'.'.$request->image->extension();     
        $request->image->move(public_path('images'), $imageName);
        Image::create(['name' => $imageName]);
          
        return response()->json('Image uploaded successfully');
    }
      
}
