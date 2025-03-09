<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\BrandStoreRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $r)
    {
        $data = $r->validated();

        try {
            Brand::create($data);
        } catch (\Throwable $th) {
            return back()->withErrors('Такой бренд уже создан!');
        }

        return to_route('admin.brand.index')->with('success', 'Бренд создан!');
    }


    // public function edit (Category $category)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Category $category)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if(!$brand){
            return redirect()->back();
        }

        $brand->delete();

        return to_route('admin.brand.index')->with('success', 'Бренд удален!');
    }
}
