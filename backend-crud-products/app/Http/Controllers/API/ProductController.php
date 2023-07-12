<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSaveRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        $products = $this->productRepository->paginate();

        return response()->json([
            'success'   => true,
            'message'   => 'list data products',
            'data'      => $products
        ], 200);
    }

    public function createProduct(ProductSaveRequest $request)
    {
        $product = $this->productRepository->create($request);

        return response()->json([
            'success'   => true,
            'message'   => 'Product Successfully Created',
            'data'      => $product
        ], 201);
    }

    public function updateProduct(ProductSaveRequest $request, $id)
    {
        $product = $this->productRepository->update($request, $id);

        return response()->json([
            'success'   => true,
            'message'   => 'Product Successfully Updated',
            'data'      => $product
        ], 201);
    }

    public function getProductById($id)
    {
        $product = $this->productRepository->fetch($id);

        if(!$product){
            return response()->json([
                'success'   => false,
                'message' => 'Data Not Found'
            ], 404);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Data Product ' . $product->name,
            'data'      => $product
        ], 200);
    }

    public function deleteProduct($id)
    {
        $this->productRepository->delete($id);
        
        return response()->json([
            'success'   => true,
            'message' => 'Product Successfully deleted'
        ], 200);
    }
}
