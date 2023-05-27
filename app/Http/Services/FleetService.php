<?php

namespace App\Http\Services;

use App\Exceptions\AlreadyBookedException;
use App\Exceptions\NonExistentException;
use App\Exceptions\OutOfOrderException;
use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use Illuminate\Support\Collection;

class FleetService
{
    private Collection $waypoints;

    /**
     * Get available seats for a trip
     */
    public function getAvailableSeats(Trip $trip, Station $source, Station $destination)
    {
        $this->prepareFleet($trip); // set the waypoints
        $this->validateFleetInquiry($source, $destination, $this->waypoints);

        $busTrip = $trip->bus()->with('seats.bookings')->first();

        $sourcePosition = $this->getStationSequenceNumber($source);
        $destinationPosition = $this->getStationSequenceNumber($destination);

        $availableTripSeats = Collection::empty();

        foreach ($busTrip->seats as $seat) {
            if ($seat->bookings->count() === 0) {
                $availableTripSeats->push($seat);

                continue;
            }

            if ($this->isSeatAvailable($seat, $sourcePosition, $destinationPosition)) {
                $availableTripSeats->push($seat);
            }
        }

        return $availableTripSeats;
    }

    /**
     * Book a trip for a user
     *
     * @param  Station  $destination
     *
     * return Booking
     */
    public function bookTrip(Trip $trip, Seat $seat, Station $source, Station $destination)
    {
        $this->prepareFleet($trip); // set the waypoints

        $this->validateFleetInquiry($source, $destination, $this->waypoints);

        $sourcePosition = $this->getStationSequenceNumber($source);
        $destinationPosition = $this->getStationSequenceNumber($destination);

        if (! $this->isSeatAvailable($seat, $sourcePosition, $destinationPosition)) {
            throw new AlreadyBookedException('The seat is already booked for this trip', 412);
        }

        return Booking::query()->create([
            'user_id' => auth()->user()->id,
            'trip_id' => $trip->id,
            'seat_id' => $seat->id,
            'source' => $source->id,
            'destination' => $destination->id,
        ]);
    }

    /**
     * Define the waypoints for a trip i.e. fleet
     *
     *
     * @return void
     */
    private function prepareFleet(Trip $trip)
    {
        $tripSource = $trip->source()->first();
        $tripDestination = $trip->destination()->first();
        $tripStops = $trip->stops()->get()->map(function ($stop) {
            return [
                'id' => $stop->id,
                'name' => $stop->name,
                'sequence' => $stop->pivot->sequence,
            ];
        });

        $this->waypoints = Collection::make([
            [
                'id' => $tripSource->id,
                'name' => $tripSource->name,
                'sequence' => 0,
            ],
            ...$tripStops,
            [
                'id' => $tripDestination->id,
                'name' => $tripDestination->name,
                'sequence' => $tripStops->count() + 1,
            ],
        ]);
    }

    /**
     * Validate the trip, source and destination
     *
     * @return void
     *
     * @throws NonExistentException
     * @throws OutOfOrderException
     */
    private function validateFleetInquiry(Station $source, Station $destination, Collection $waypoints)
    {
        // assure that the source and destination are in the trip
        if (
            ! $waypoints->contains('id', $source->id) ||
            ! $waypoints->contains('id', $destination->id)
        ) {
            throw new NonExistentException('one of the requested stations is not in the trip');
        }

        $sourceSequence = $this->getStationSequenceNumber($source);
        $destinationSequence = $this->getStationSequenceNumber($destination);

        if ($sourceSequence > $destinationSequence) {
            throw new OutOfOrderException(
                'The source station must be before the destination station according to the trip',
                412
            );
        }
    }

    /**
     * Check if the seat is available for the requested trip
     *
     * @param  int  $source sequence number of the requested source station
     * @param  int  $destination sequence number of the requested destination station
     * @return bool
     */
    private function isSeatAvailable(Seat $seat, int $source, int $destination)
    {
        foreach ($seat->bookings as $booking) {
            $bookingSource = $this->getStationSequenceNumber($booking->source()->first());
            $bookingDestination = $this->getStationSequenceNumber($booking->destination()->first());

            $overlapped = Helper::checkOverlapping(
                $source,
                $destination,
                $bookingSource,
                $bookingDestination
            );

            if ($overlapped) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the sequence number of a station in a trip
     *
     * @return int
     */
    private function getStationSequenceNumber(Station $station)
    {
        return $this->waypoints->firstWhere('id', $station->id)['sequence'];
    }
}
