<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::paginate();
    // dd($categories);
    return view('admin.category.index',compact('categories'));
  }
  public function create()
{
    $category = new Category();
    return view('admin.category.create', compact('category'));

}
public function store(Request $request)
{

    // without Validation

    $data = $request->all();
    if (!$data['slug']) {
        $data['slug'] = Str::slug($data['name']);
    }

     Category::create($data);
    return redirect()
            ->route('category.index')
            ->with('success', 'Category created!');
}

}
