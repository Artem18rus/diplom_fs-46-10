<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Day;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $day1 = Day::create([
            'day_week' => 'Пн',
            'date' => 31,
        ]);

        $day2 = Day::create([
            'day_week' => 'Вт',
            'date' => 1,
        ]);

        $day3 = Day::create([
            'day_week' => 'Ср',
            'date' => 2,
        ]);

        $day4 = Day::create([
            'day_week' => 'Чт',
            'date' => 3,
        ]);

        $day5 = Day::create([
            'day_week' => 'ПТ',
            'date' => 4,
        ]);

        $day6 = Day::create([
            'day_week' => 'Сб',
            'date' => 5,
        ]);
    }
}
