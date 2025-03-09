<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $r)
    {
        $data = $r->validated();

        Category::create($data);

        return to_route('admin.category.index')->with('succsess', 'Категория создана');
    }


    // public function edit(Category $category)
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
        $category = Category::find($id);

        if(!$category){
            return redirect()->back();
        }

        $category->delete();

        return to_route('admin.category.index')->with('success', 'Категория удалена!');
    }
}
