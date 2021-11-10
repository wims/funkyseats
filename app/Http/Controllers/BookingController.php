<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Rules\AlreadyBookedRule;
use Illuminate\Http\Request;

use Carbon\Carbon;

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * * @param  \Illuminate\Http\Request  $request * @return \Illuminate\Http\Response */ public function store($seat_id, Request $request)
    {
        $request->merge(['user_id' => auth()->user()->id,]);
        $request->validate([
            //     'title' => ['required', 'unique:posts', 'max:255'],
            //     'body' => ['required'],
            'user_id' => [new AlreadyBookedRule()],
        ]);
        $booking = new Booking;

        $booking->from = Carbon::today();
        $booking->to = Carbon::tomorrow();
        $booking->seat_id = $seat_id;
        $booking->user_id = $request->user_id;
        $booking->approved = True;

        $booking->save();

        return back()->with('success', 'You booked the seat successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
