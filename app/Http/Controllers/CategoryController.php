<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\UpdateCategoryRequest;
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

    public function store(CategoryStoreRequest $r)
    {
        $data = $r->validated();

        Category::create($data);

        return to_route('admin.category.index')->with('succsess', 'Категория создана');
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $r,$id)
    {
        $validatedData = $r->validated();

        $category = Category::findOrFail($id);

        $category->update($validatedData);

        return to_route('admin.category.index')->with('success', 'Категория успешна обновлена!');
    }

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
