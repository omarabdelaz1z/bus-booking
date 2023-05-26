<?php

namespace App\Http\Services;

use App\Exceptions\NonExistentException;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;

class FleetService
{
    /**
     * Book a trip for a user
     *
     * @param  Trip  $trip
     * @param  Seat  $seat
     * @param  Station  $source
     * @param  Station  $destination
     *
     * return Booking
     */
    public function bookTrip($trip, $seat, $source, $destination)
    {

    }

    /**
     * Get available seats for a trip
     *
     * @param  Trip  $trip
     * @param  Station  $source
     * @param  Station  $destination
     */
    public function getAvailableSeats($trip, $source, $destination)
    {
        $stops = $trip->stops()->get();

        // assure that the source and destination are in the trip
        if (
            $stops->pluck('station_id')
                ->whereIn('station_id', [$source->id, $destination->id])
                ->count() != 2
        ) {
            throw new NonExistentException('one of the requested stations is not in the trip');
        }
    }
}
