<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'weight',
        'height',
        'age',
        'sex',
        'role',
        'activity_level_id',
        'email',
        'password',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $appends = ['daily_calories', 'daily_macros'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function activityLevel(): BelongsTo
    {
        return $this->belongsTo(ActivityLevel::class);
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function getDailyCaloriesAttribute()
    {
        if (!$this->activityLevel) {
            return 0;
        }

        $bmr = ($this->weight * 10) + (6.25 * $this->height) + (5 * $this->age);
        $bmr = ($this->sex === 'man') ? $bmr + 5 : $bmr - 161;

        return round($bmr * $this->activityLevel->coefficient);
    }

    public function getDailyMacrosAttribute()
    {
        $total = $this->daily_calories;

        return [
            'proteins' => round(($total * 0.30) / 4),
            'fats' => round(($total * 0.30) / 9),
            'carbs' => round(($total * 0.40) / 4)
        ];
    }
}
