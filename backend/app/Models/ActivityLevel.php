<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLevel extends Model
{
    protected $fillable = [
        'key',
        'name',
        'coefficient',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
