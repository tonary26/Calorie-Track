<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'calories',
        'proteins',
        'fats',
        'carbs'
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_items')
                    ->withPivot('weight_gram')
                    ->withTimestamps();
    }
}
