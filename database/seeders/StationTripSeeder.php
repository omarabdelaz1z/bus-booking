<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class StationTripSeeder extends Seeder
{
    const NUMBER_OF_STATIONS = 27; // Assuming we have 27 stations in the database

    public function run(): void
    {
        $chunkSize = round(self::NUMBER_OF_STATIONS / 4, mode: PHP_ROUND_HALF_UP);

        Station::query()->chunk($chunkSize, function (Collection $stations) {
            $source = $stations->first();
            $destination = $stations->last();

            $stops = $stations->slice(1, $stations->count() - 2);

            Trip::query()->create([
                'source' => $source->id,
                'destination' => $destination->id,
            ])->stops()->attach(
                $stops->mapWithKeys(function (Station $station, int $index) {
                    return [$station->id => ['sequence' => $index]];
                })
            );
        });
    }
}
