<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookTripSeat;
use App\Http\Requests\ListTripSeat;
use App\Http\Services\FleetService;
use App\Models\Station;
use App\Models\Trip;
use App\Models\User;

class FleetController extends Controller
{
    protected FleetService $fleetService;

    public function __construct(FleetService $fleetService)
    {
        $this->fleetService = $fleetService;
    }

    public function book(BookTripSeat $request, User $user)
    {

    }

    public function getAvailableTripSeats(ListTripSeat $request, Trip $trip)
    {
        $validated = $request->validated();

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

        $this->fleetService->getAvailableSeats($trip, $source, $destination);
    }
}
