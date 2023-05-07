<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {
    public function index() {
        $products = Product::paginate(7);
        return view('admin.index', compact('products'));
    }
    public function create() {
        $product = new Product();
        $category = Category::all();
        return view('admin.create', compact('product', 'category'));
    }
    public function store(Request $request) {

        $data = $request->except('img', 'user_id');
        $data['user_id'] = Auth::user()->id;
        $data['img'] = $this->uploadAttachments($request);
        Product::create($data);
        return redirect()->
            route('product.index')->
            with('success', 'Product Created!');
    }
    public function edit($id) {
        return view('admin.edit', [
            'product' => Product::findOrFail($id),
            'category' => Category::all(),
        ]);
    }
    public function update(Request $request, $id) {

        $product = Product::findOrFail($id);
        $data['user_id'] = Auth::user()->id;
        $data['img'] = array_merge(($product->img ?? []), $this->uploadAttachments($request));

        $product->update($data);
        return redirect()->
            route('product.index')->
            with('success', 'Product Updated!');
    }
    public function destroy($id) {
        $product = Product::findOrFail($id);
        // foreach ($product->img as $image) {
        //     // unlink(storage_path('app/public/' . $file));
        //     Storage::disk('public')->delete($image);
        // }

        foreach ($product->img as $image) {
            if (File::exists('storage/product-image/' . $image->img)) {
                File::delete("storage/product-image/" . $image->img);
            }
        }

        Product::destroy($id);
        return redirect()->
            route('product.index')->
            with('success', 'Product Deleted!');
    }

    protected function uploadAttachments(Request $request) {
        if (!$request->hasFile('img')) {
            return;
        }
        $files = $request->file('img');
        $img = [];
        foreach ($files as $file) {
            if ($file->isValid()) {
                $path = $file->store('/product-image', [
                    'disk' => 'public',
                ]);
                $img[] = $path;
            }
        }

        return $img;
    }

    public function deleteImages($id,$key)
    {
$product = Product::findOrFail($id);
$img = $product->img[$key];
    if (File::exists('storage/' . $img )) {

        Storage::disk('public')->delete($img);
      File::delete('storage/' . $img );

    }
        return redirect()->route('product.edit',$product);
    }

}
