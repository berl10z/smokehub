<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Storage;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::with('category:id,name')->paginate(perPage: 20);
        $productCount = Product::count();
        return view('admin.index',compact('products','productCount'));
    }
    public function trash()
    {
        $trash = Product::onlyTrashed()->get();
        $trashCount = Product::onlyTrashed()->count();
        return view('admin.trash',compact('trash', 'trashCount'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.create',compact('categories','brands'));
    }

    public function store(StoreProductRequest $r)
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('products','public');
        }

        Product::create($data);

        return to_route('admin.index')->with('success', 'Товар создан!');
    }

    public function increment($id)
    {
        Product::findOrFail($id)->increment('count');
        return back();
    }

    public function decrement($id)
    {
        Product::findOrFail($id)->decrement('count');
        return back();
    }

    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::withTrashed()->findOrFail($id);
        return view('admin.edit', compact( 'categories','brands','product',));
    }

    public function update(UpdateProductRequest $r, $id)
    {
        $data = $r->validated();

        $product = Product::withTrashed()->findOrFail($id);

        if ($r->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $r->file('image')->store('products', 'public');
        }

        $product->update($data);

        return to_route('admin.index')->with('success', 'Товар успешно обновлен!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product){
            return redirect()->back();
        }

        $product->delete();

        return to_route('admin.index')->with('success', 'Товар удален!');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->forceDelete();

        return to_route('admin.trash')->with('success', 'Товар удален навсегда');
    }

    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product) {
            $product->restore();

            return redirect()->route('admin.index')->with('success', 'Товар успешно восстановлен!');
        }

        return redirect()->route('admin.index')->with('error', 'Товар не найден.');
    }
}
