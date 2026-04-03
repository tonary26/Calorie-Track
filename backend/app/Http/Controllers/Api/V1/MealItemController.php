<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Meal;
use App\Http\Requests\MealItem\MealItemStoreRequest;

class MealItemController extends Controller
{
    public function store(Meal $meal, MealItemStoreRequest $request)
    {
        $meal->products()->attach($request->product_id, [
            'weight_gram' => $request->weight_gram
        ]);

        return response()->json([
            'message' => 'Successful created.'
        ], 201);
    }

    public function destroy(Meal $meal, Product $product)
    {
        $meal->products()->detach($product->id);

        return response()->json([
            'message' => 'Successful deleted/'
        ]);
    }
}
