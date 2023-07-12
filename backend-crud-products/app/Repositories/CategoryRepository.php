<?php
namespace App\Repositories;

use App\Models\Category;


class CategoryRepository
{
    public function index()
    {
        $categories = Category::get();
        return $categories;
    }

    public function create($request)
    {
        $category = Category::create([
            'name'      => $request->name,
        ]);

        return $category;
    }

    public function getCategoryById($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function update($request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name'      => $request->name,
        ]);

        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete($id);

        return $category;
    }
}