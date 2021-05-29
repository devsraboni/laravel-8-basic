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
            'brand_name' => "required|min:3|unique:brands",
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


    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => "required|min:3",
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $image_name = hexdec(uniqid()) . '.' . strtolower($brand_image->getClientOriginalExtension());
            $image = 'image/brand/'.$image_name;
            $brand_image->move('image/brand/',$image_name);

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $image,
            ]);
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
            ]);
        }

        return back()->with('success', 'Brand Updated Successfully!!');
    }

}
