<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Apartment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('apartments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoomRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        $apartment = Apartment::findOrFail($request->input('apartment_id'));
        // why is it not validate?
        // is there any different from room update method?
        // TODO: find out later
        $validated = $request->validate([
            'floor' => ["required", "integer", "max:".$apartment->floors]
        ]);

        $room = new Room();
        $room->apartment_id = $request->input('apartment_id');
        $room->floor = $request->input('floor');
        $room->name = $request->input('name');
        $room->type = $request->input('type');
        $room->save();

        return redirect()->route('apartments.show', ['apartment' => $room->apartment_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('rooms.show', [
            'room' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $room_types = Room::$room_types;
        array_push($room_types, 'EXTRA');
        array_push($room_types, 'EXTRA2');
        return view('rooms.edit', [
            'room' => $room,
//            'room_types' => Room::$room_types,
            'room_types' => $room_types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoomRequest $request
     * @param \App\Models\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, Room $room)
    {
        $validated = $request->validate([
            'floor' => ["required", "integer", "max:".$room->apartment->floors]
        ]);

        $room->name = $request->input('name');
        $room->floor = $request->input('floor');
        $room->type = $request->input('type');
        $room->save();

        return redirect()->route('rooms.show', ['room' => $room->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
