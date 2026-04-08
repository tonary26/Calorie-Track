<?php

namespace Database\Seeders;

use App\Http\Requests\Meal\MealStoreRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ActivityLevelSeed::class,
        ]);
    }
}
