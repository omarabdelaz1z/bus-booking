<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    public function run(): void
    {
        $stations = [
            'cairo',
            'giza',
            'alexandria',
            'dakahlia',
            'red-sea',
            'beheira',
            'fayoum',
            'gharbiya',
            'ismailia',
            'menofia',
            'minya',
            'qaliubiya',
            'new-valley',
            'suez',
            'aswan',
            'assiut',
            'beni-suef',
            'port-said',
            'damietta',
            'sharkia',
            'south-sinai',
            'kafr-sheikh',
            'matrouh',
            'luxor',
            'qena',
            'north-sinai',
            'sohag',
        ];

        Station::insert(collect($stations)->map(function ($station) {
            return ['name' => $station];
        })->toArray());
    }
}
