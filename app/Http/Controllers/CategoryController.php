<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ],
        [
            'name.required' => 'Give A Category Name',
            'name.unique' => 'Make the Category Name unique',
            'name.max' => 'The Category Name is too long',
        ]);
    }
}
