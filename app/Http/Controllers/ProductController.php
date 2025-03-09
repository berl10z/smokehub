<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->limit(5)->get();

        return view('index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('show',compact('product'));
    }

    public function catalog(Request $r)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $productsQuery = Product::with('category:id,name');

        $productsQuery->when($r->category_id,fn($q,$category_id) => $q->where('category_id', $category_id))
            ->when($r->brand_id,fn($q,$brand_id) => $q->where('brand_id',$brand_id))
            ->when($r->name,fn($q,$name) =>$q->where('name', 'LIKE', "%$name%") );

        $products = $productsQuery->get();

        return view('catalog',compact('products','categories','brands'));
    }
}
