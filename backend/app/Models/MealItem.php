<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MealItem extends Pivot
{
    public function meals()
    {
        return $this->belongsTo(Meal::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
