<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => "required|min:4|unique:brands",
            'brand_image' => "required|mimes:png,jpg,jpeg",
        ]);

        $brand_image = $request->file('brand_image');
        $image_name = hexdec(uniqid()) . '.' . strtolower($brand_image->getClientOriginalExtension());
        $image = 'image/brand/'.$image_name;
        $brand_image->move('image/brand/',$image_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $image,
        ]);
        return back()->with('success', 'Brand Created Successfully!!');
    }
}
