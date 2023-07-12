<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    public function paginate()
    {
        $sort_by = request()->sort_by ?? "id";
        $sort_by_order = request()->sort_by_order ?? "ASC";
        $per_page = request()->per_page ?? 10;
        $search = request()->search;

        $products = Product::with('category')
                    ->orderBy($sort_by, $sort_by_order)
                    ->when($search, function($query) use ($search){
                        $query
                        ->Where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%');
                    })
                    ->paginate($per_page);

        return $products;
    }

    public function create($request)
    {
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/products', $filename);

        $product = Product::create([
            'name'                      => $request->name,
            'category_id'               => $request->category_id,
            'description'               => $request->description,
            'price'                     => $request->price,
            'qty'                       => $request->qty,
            'image'                     => $filename
        ]);

        return $product;
    }

    public function fetch($id)
    {
        $product = Product::with('category')->find($id);

        return $product;
    }

    public function update($request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->file('image')) {

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/products', $filename);

            Storage::delete('public/products/'.$product->image);

            $product->update([
                'name'                      => $request->name,
                'category_id'               => $request->category_id,
                'description'               => $request->description,
                'price'                     => $request->price,
                'qty'                       => $request->qty,
                'image'                     => $filename,
            ]);
            
        }else{

            $product->update([
                'name'                      => $request->name,
                'category_id'               => $request->category_id,
                'description'               => $request->description,
                'price'                     => $request->prices,
                'qty'                       => $request->qty
            ]);
        }

        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/products/'.$product->image);
        $product->delete();

        return $product;
    }
}