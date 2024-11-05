<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,JPEG,PNG|max:2048',
            ], [
                'image.required' => 'Please upload an image.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'Only jpeg and png images are allowed.',
                'image.max' => 'The image size must not exceed 2MB.'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('images', 'public');
                Image::create([
                    'filepath' => $imagePath
                ]);
            }

            return redirect('/');
        }

        $images = Image::all();
        return view('upload', compact('images'));
    }
}
