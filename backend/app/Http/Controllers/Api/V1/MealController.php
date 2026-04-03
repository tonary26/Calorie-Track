<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meal;
use App\Http\Requests\Meal\MealStoreRequest;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::with('products')->where('user_id', auth()->id())->get();

        return response()->json([
            'meals' => $meals
        ]);
    }

    public function store(MealStoreRequest $request)
    {
        $data = $request->validated();
        $meal = Meal::create($data);

        return response()->json([
            'meal' => $meal
        ], 201);
    }

    public function show(Meal $meal)
    {
        return response()->json([
            'meal' => $meal
        ]);
    }

    public function destroy(Meal $meal)
    {
        $meal->delete();

        return response()->json([
            'message' => 'Meal successful deleted.'
        ], 204);
    }
}
