<?php

namespace App\Http\Controllers;

use App\Models\SeatType;
use Illuminate\Http\Request;
use App\Models\Seat;

class SeatTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required'],
        ]);
        $seatType = new SeatType;
        $seatType->name = $request->name;
        $seatType->description = $request->description;

        $seatType->save();
        return back()->with('success', 'Vellykket lagring av ny setetype');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function show(SeatType $seatType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function edit(SeatType $seatType)
    {
        return View('pages.admin.edit_seat_types', ['types' => SeatType::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeatType $seatType)
    {
        $request->validate([
            'name' => ['required',],
            'description' => ['required',],
        ]);

        $seatType->name = $request->name;
        $seatType->description = $request->description;

        $seatType->save();

        return back()->with('success', 'Vellykket oppdatering av setetype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeatType  $seatType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $temp = SeatType::where('name', 'unknown')->get()->first();

        if (!$temp) {
            $newDefault = new SeatType;
            $newDefault->name = 'ukjent';
            $newDefault->description = 'Typen er generert av systemet';
            $newDefault->save();
            $temp = $newDefault;
        }

        Seat::where('seat_type_id', $id)->update(['seat_type_id' => $temp->id]);

        SeatType::destroy($id);

        return back()->with('success', 'Sletting av setetypen var vellykket');
    }
}
