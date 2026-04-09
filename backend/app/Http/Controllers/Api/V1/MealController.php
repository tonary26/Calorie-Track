<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meal;
use App\Http\Requests\Meal\MealStoreRequest;
use Carbon\Carbon;

class MealController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $today = Carbon::today();

        $types = ['🌅 Breakfast', '☀️ Lunch', '🌙 Dinner'];

        foreach ($types as $type) {
            $exist = Meal::where('user_id', $user)
                ->where('type', $type)
                ->whereDate('created_at', $today)
                ->exists();

            if (!$exist) {
                Meal::create([
                    'type' => $type,
                    'user_id' => $user,
                    'created_at' => $today
                ]);
            }
        }

        $meals = Meal::with('products')
            ->where('user_id', auth()->id())
            ->whereDate('created_at', $today)
            ->get();

        return response()->json([
            'meals' => $meals
        ]);
    }

    public function store(MealStoreRequest $request)
    {
        $data = $request->validated();
        $meal = Meal::create([
            ...$data,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'meal' => $meal
        ], 201);
    }

    public function show(Meal $meal)
    {
        return response()->json([
            'meal' => $meal->load('products')
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
