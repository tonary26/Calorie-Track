<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityLevel\StoreActivityLevelRequest;
use App\Models\ActivityLevel;

class ActivityLevelController extends Controller
{
    public function index()
    {
        return response()->json([
            'activity_levels' => ActivityLevel::all()
        ]);
    }

    public function store(StoreActivityLevelRequest $request)
    {
        $data = $request->validated();
        $activityLevel = ActivityLevel::create($data);

        return response()->json([
            'activity_level' => $activityLevel
        ], 201);
    }
}
