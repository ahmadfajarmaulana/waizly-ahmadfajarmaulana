<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySaveRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        $categories = $this->categoryRepository->index();

        return response()->json([
            'success'   => true,
            'message'   => 'list data category',
            'data'      => $categories
        ], 200);
    }

    public function createCategory(CategorySaveRequest $request)
    {
        $category = $this->categoryRepository->create($request);

        return response()->json([
            'success'   => true,
            'message'   => 'Category Successfully Created',
            'data'      => $category
        ], 201);
    }

    public function updateCategory(CategorySaveRequest $request, $id)
    {
        $category = $this->categoryRepository->update($request, $id);

        return response()->json([
            'success'   => true,
            'message'   => 'Category Successfully Updated',
            'data'      => $category
        ], 201);
    }

    public function getCategoryById($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if(!$category){
            return response()->json([
                'success'   => false,
                'message' => 'Data Not Found'
            ], 404);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Data Category',
            'data'      => $category
        ], 200);
    }

    public function deleteCategory($id)
    {
        $this->categoryRepository->delete($id);
        
        return response()->json([
            'success'   => true,
            'message' => 'Category Successfully deleted'
        ], 200);
    }
}
