<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLevel;

class ActivityLevelSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activityLevels = [
            [
                'key' => 'sedentary',
                'name' => 'Sedentary lifestyle',
                'coefficient' => 1.2,
                'description' => 'Minimum movement, work on the computer, no sports.'
            ],
            [
                'key' => 'light',
                'name' => 'Low activity',
                'coefficient' => 1.375,
                'description' => 'Light exercise or walking 1-3 times a week.'
            ],
            [
                'key' => 'moderate',
                'name' => 'Moderate activity',
                'coefficient' => 1.55,
                'description' => 'Intense, moderate-level training 3-5 times a week.'
            ],
            [
                'key' => 'high',
                'name' => 'High activity',
                'coefficient' => 1.725,
                'description' => 'Heavy physical activity or daily sports.'
            ],
            [
                'key' => 'extreme',
                'name' => 'Extreme activity',
                'coefficient' => 1.9,
                'description' => 'Professional athletes or heavy physical labor (for example, construction).'
            ],
        ];

        foreach ($activityLevels as $level) {
            ActivityLevel::firstOrCreate(
                ['key' => $level['key']],
                $level);
        }
    }
}
