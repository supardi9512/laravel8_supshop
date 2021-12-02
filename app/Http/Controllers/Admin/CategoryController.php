<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = NULL;

        return view('admin.category.form', $this->data);
    }

    public function store(CategoryRequest $request)
    {
        $data_category = $request->validated();

        Category::create(
            [
                'name'      => $data_category['name'],
                'slug'      => Str::slug($data_category['name']),
                'parent_id' => (int) $data_category['parent_id'],
            ]
        );

        return redirect()->route('admin.categories')->with(['message' => "Category has been added!", 'alert-type' => 'success']);
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = $category;

        return view('admin.category.form', $this->data);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data_category = $request->validated();

        $category->update(
            [
                'name'      => $data_category['name'],
                'slug'      => Str::slug($data_category['name']),
                'parent_id' => (int) $data_category['parent_id'],
            ]
        );

        return redirect()->route('admin.categories')->with(['message' => "Category has been updated!", 'alert-type' => 'success']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')->with(['message' => "Category has been deleted!", 'alert-type' => 'success']);
    }
}
