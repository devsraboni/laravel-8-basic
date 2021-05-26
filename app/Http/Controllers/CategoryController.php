<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Category::insert([
        //     'user_id' => Auth::user()->id,
        //     'category_name' => $request->name,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        // $category = new Category();
        // $category->user_id = Auth::user()->id;
        // $category->category_name = $request->name;
        // $category->save();

        $category = array();
        $category['category_name'] = $request->name;
        $category['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($category);

        return back()->with('success', 'Category has Created Successfully!!');
    }
}
