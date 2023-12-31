<?php

namespace App\Http\Controllers;

use App\Events\TripAccepted;
use App\Events\TripEnded;
use App\Events\TripStarted;
use App\Events\TripUpdated;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'destination_name' => 'required'
        ]);


        $request->user()->trips()->create($request->only([
            'origin',
            'destination',
            'destination_name'
        ]));


        return $request->user()->trips;
    }


    public function show(Request $request, Trip $trip)
    {
        // is the trip associated with the authenticated user
        if ($trip->user->id === $request->user()->id) {
            return $trip;
        }

        if ($trip->driver && $request->driver) {

            if ($trip->driver->id === $request->user()->driver->id) {
                return $trip;
            }
        }


        return response()->json(['message' => 'Cannot find this trip.'], 404);
    }

    public function accept(Request $request, Trip  $trip)
    {
        $request->validate([
            'driver_location' => 'required'
        ]);

        // a driver accept a trip
        $trip->update([
            'driver_id' => $request->user()->id,
            'driver_location' => $request->driver_location
        ]);

        TripAccepted::dispatch($trip, $request->user());

        $trip->load('driver.user');

        return $trip;
    }

    public function start(Request $request, Trip  $trip)
    {
        // a driver has started a strip
        $trip->update([
            'is_started' => true
        ]);

        TripStarted::dispatch($trip, $request->user());

        $trip->load('driver.user');

        return $trip;
    }


    public function end(Request $request, Trip  $trip)
    {
        // a driver ended a trip
        $trip->update([
            'is_complete' => true
        ]);

        TripEnded::dispatch($trip, $request->user());

        $trip->load('driver.user');

        return $trip;
    }


    public function location(Request $request, Trip  $trip)
    {

        $request->validate([
            'driver_location' => 'required'
        ]);


        // update a driver current location
        $trip->update([
            'driver_location' => $request->driver_location
        ]);

        TripUpdated::dispatch($trip, $request->user());

        $trip->load('driver.user');

        return $trip;
    }
}