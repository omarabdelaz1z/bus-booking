<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookTripSeat;
use App\Http\Requests\ListTripSeat;
use App\Http\Resources\TripSeatResource;
use App\Http\Services\FleetService;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use App\Models\User;

class FleetController extends Controller
{
    protected FleetService $fleetService;

    /**
     * Create a fleet controller instance.
     *
     * @return void
     */
    public function __construct(FleetService $fleetService)
    {
        $this->fleetService = $fleetService;
    }

    public function getAvailableTripSeats(ListTripSeat $request, Trip $trip)
    {
        $validated = $request->validated();

        if ($validated['source'] === $validated['destination']) {
            return response()->json([
                'message' => 'Source and destination cannot be the same',
            ], 400);
        }

        $stations = Station::query()
            ->whereIn('name', [$validated['source'], $validated['destination']])
            ->get();

        if ($stations->count() !== 2) {
            return response()->json([
                'message' => 'Invalid source or destination',
            ], 400);
        }

        $source = $stations->firstWhere('name', $validated['source']);
        $destination = $stations->firstWhere('name', $validated['destination']);

        return TripSeatResource::collection(
            $this->fleetService
                ->getAvailableSeats($trip, $source, $destination)
        );
    }

    public function bookTripSeat(BookTripSeat $request, User $user)
    {
        $validated = $request->validated();

        if ($validated['source'] === $validated['destination']) {
            return response()->json([
                'message' => 'Source and destination cannot be the same',
            ], 400);
        }

        $stations = Station::query()
            ->whereIn('name', [$validated['source'], $validated['destination']])
            ->get();

        if ($stations->count() !== 2) {
            return response()->json([
                'message' => 'Invalid source or destination',
            ], 400);
        }

        $source = $stations->firstWhere('name', $validated['source']);
        $destination = $stations->firstWhere('name', $validated['destination']);

        $trip = Trip::query()
            ->where('id', $validated['trip'])
            ->first();

        $seat = Seat::query()
            ->where('id', $validated['seat'])
            ->first();

        return
            response()->json(
                $this->fleetService->bookTrip($trip, $seat, $source, $destination),
                201
            );
    }
}
