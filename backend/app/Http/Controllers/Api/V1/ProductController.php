<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\Product\ProductStoreRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Product::query()->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->orderBy('name')
          ->paginate(20);

        return response()->json([
            'products' => $products
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'product' => $product
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);

        return response()->json([
            'products' => $product
        ], 201);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product successful deleted.'
        ], 204);
    }
}
