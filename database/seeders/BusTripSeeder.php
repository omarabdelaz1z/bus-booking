<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class BusTripSeeder extends Seeder
{
    const NUMBER_OF_STATIONS = 27; // Assuming we have 27 stations in the database

    const SEATS_PER_BUS = 12;

    public function run(): void
    {
        $bus = Bus::factory()->has(
            Seat::factory()->count(self::SEATS_PER_BUS)
        )->create()->first();

        $numberOfTrips = round(self::NUMBER_OF_STATIONS / 4, mode: PHP_ROUND_HALF_UP);

        Station::query()->chunk($numberOfTrips, function (Collection $stations) use ($bus) {
            $source = $stations->first();
            $destination = $stations->last();

            $stops = $stations->slice(1, $stations->count() - 2);
            Trip::query()->create([
                'source' => $source->id,
                'destination' => $destination->id,
                'bus_id' => $bus->id,
            ])->stops()->attach(
                $stops->mapWithKeys(function (Station $station, int $index) {
                    return [$station->id => ['sequence' => $index]];
                })
            );
        });
    }
}
