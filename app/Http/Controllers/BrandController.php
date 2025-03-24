<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBrandRequest;
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


    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit',compact('brand'));
    }

    public function update(UpdateBrandRequest $r, $id)
    {
        $validatedData = $r->validated();

        $brand = Brand::findOrFail($id);

        $brand->update($validatedData);

        return to_route('admin.brand.index')->with('success', 'Бренд успешно обновлен!');
    }

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
