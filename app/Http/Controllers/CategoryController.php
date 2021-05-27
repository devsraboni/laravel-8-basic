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
        $categories = Category::latest()->paginate(5);
        $trashes = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Category::insert([
            'user_id' => Auth::user()->id,
            'category_name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Category has Created Successfully!!');
    }

    public function edit($id)
    {
        // $category = Category::find($id);
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        // $category = Category::find($id)->update([
        //     'category_name' => $request->name,
        //     'user_id' => Auth::user()->id,
        // ]);

        $category = array();
        $category['category_name'] = $request->name;
        $category['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($category);
        return redirect()->route('category.index')->with('success', 'Category has Updated Successfully!!');
    }


    public function softDelete($id)
    {
        $category = Category::find($id)->delete();
        return back()->with('success', 'Category Moved to Trash!!');
    }
}
