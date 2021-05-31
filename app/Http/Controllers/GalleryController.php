<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
// use Image;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery_image' => "required",
        ]);

        $gallery_image = $request->file('gallery_image');
        foreach ($gallery_image as $single_image)
        {
            $image_name = hexdec(uniqid()) . '.' . $single_image->getClientOriginalExtension();

            Image::make($single_image)->resize(300,200)->save('image/gallery/'.$image_name);
            $image = 'image/gallery/'.$image_name;

            Gallery::insert([
                'image' => $image,
            ]);
        }
        return back()->with('success', 'Brand Created Successfully!!');

    }
}
