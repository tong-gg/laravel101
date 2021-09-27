<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentRequest;
use App\Models\Apartment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        // if user login, then check role
        if (Auth::check()) {
            if (Auth::user()->isRole('OFFICER')) {
                $apartments = Apartment::whereUserId(Auth::id())->with('rooms')->get();
            } else {
                $apartments = Apartment::with('rooms')->get();
            }
        } else {
            $apartments = Apartment::with('rooms')->get();
        }
        return view('apartments.index', [
            'apartments' => $apartments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (Gate::denies('create-apartment')) {
//            return abort(401);
//        }
//        $this->authorize('create', Apartment::class);
        if (Auth::user()->cannot('create', Apartment::class)) {
            return redirect()->route('apartments.index');
        }
        return view('apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApartmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentRequest $request)
    {
        // validation is in store and update

        // if error, redirect to where request was sent
        // validate store + create
//        $validated = $request->validate([
//           'name' => 'required|min:3'
//           'name' => ['required', 'min:3', 'max:255'], // you can use vertical bar(pipe)
//           'floors' => ['required', 'integer', 'min:1']
//        ]);

        // some schema maybe different from ModelRequest
        // we can define a different schema from ModelRequest
        // this schema tell us that, name MUST BE UNIQUE in apartments table
       $this->authorize('create', Apartment::class);
        $validator = Validator::make($request->all(), [
            'name' => [
                Rule::unique('apartments'),
            ]
        ])->validate();

        $apartment = new Apartment();
        $apartment->name = $request->input('name');
        $apartment->floors = $request->input('floors');
        $apartment->save();

        return redirect()->route('apartments.index');
    }


    /**
     * Show form to create new room in this apartment
     *
     * @param $apartment_id
     */
    public function createRoom(Request $request, $apartment_id)
    {
        $apartment = Apartment::findOrFail($apartment_id);
        // if need model, pass model. else pass ModelClass
        $this->authorize('update', $apartment);
        $room_types = Room::$room_types;
        array_push($room_types, 'EXTRA');
        array_push($room_types, 'EXTRA-2');

        return view('apartments.create-room', [
            'apartment' => $apartment,
            // 'room_types => Room::$room_types // correct
            'room_types' => $room_types // just for testing validation
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::with('rooms')->findOrFail($id);
       $this->authorize('view', $apartment);
        return view('apartments.show', [
            'apartment' => $apartment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);
        $this->authorize('update', $apartment);
        return view('apartments.edit', [
            'apartment' => $apartment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApartmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    // using RequestClass, you don't need to define schema in controller!
    public function update(ApartmentRequest $request, $id)
    {
        // from store, we define some case
        // name must be unique in apartments, but except this editing id
        $apartment = Apartment::findOrFail($id);
        $this->authorize('update', $apartment);
        $validator = Validator::make($request->all(), [
            'name' => [
                Rule::unique('apartments')->ignore($id),
            ]
        ])->validate();

        $apartment->name = $request->input('name');
        $apartment->floors = $request->input('floors');

        // $request->floors; ทำได้เหมือนกัน แต่ระวังเรื่อง key ตรงกับ reserved word
        // แนะนำใช้ input(keyname) จะปลอดภัยกว่า
        $apartment->save();

        return redirect()->route('apartments.show', ['apartment' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);
        $this->authorize('delete', $apartment);
        if ($apartment->name == $request->input('name')) {
            $apartment->delete();
            return redirect()->route('apartments.index');
        }

        return redirect()->back();
    }
}
