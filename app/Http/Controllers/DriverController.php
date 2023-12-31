<?php

namespace App\Http\Controllers;

use App\Http\Resources\DriverCollection;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::with('user')->get();

        // return $drivers;

        return DriverResource::collection($drivers);
        // return new DriverCollection($drivers->keyBy->id);
        // return new DriverCollection($drivers);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Request $request)
    {
        $user = $request->user();

        $user->load('driver');


        // return back the user and associated driver
        return $user;

        // return DriverResource::make(Driver::with('user')->findOrFail($request->user()->id));
    }


    public function update(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|between:2010,2024',
            'make' => 'required',
            'model' => 'required',
            'color' => 'required|alpha',
            'license_plate' => 'required',
            'name' => 'required'
        ]);


        $user = $request->user();

        // update name
        $user->update($request->only('name'));

        // create or update a driver associate with this user
        $user->driver()->updateOrCreate($request->only([
            'year',
            'make',
            'model',
            'color',
            'license_plate'
        ]));

        $user->load('driver');

        return $user;
    }


    public function destroy(string $id)
    {
        //
    }
}
