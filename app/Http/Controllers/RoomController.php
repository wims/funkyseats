<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;


class RoomController extends Controller
{
    //

    public function index()
    {
        return View('pages/home', ['rooms' => Room::all()]);
    }

    public function edit()
    {
        return View('pages/admin/edit_rooms', ['rooms' => Room::all()]);
    }

    public function delete($id)
    {
        Room::destroy($id);
        return back()->with('success', 'You deleted the room successfully');
    }

    public function save($id, Request $request)
    {
        $room = Room::find($id);
        $room->name = $request->name;

        $room->save();

        return back();
    }

    public function index_withCountSeats()
    {
        return view('pages/home', ['rooms' => Room::withCount(['seat' => function ($q) {
            $q
                ->whereDoesntHave("booking", function ($query) {
                    $query
                        ->where('from',  '<=', Carbon::now())
                        ->where('to',  '>=', Carbon::now());
                });
        }])->get()]);
    }

    public function show($id)
    {
        return View(
            'pages/seats',
            ['room' => Room::where('id', $id)
                ->with(['seat' => function ($query) {
                    if (env('DB_CONNECTION') == "mysql") {
                        $query->orderByRaw('CHAR_LENGTH(seat_number)');
                    } else {
                        $query->orderByRaw('LENGTH(seat_number)');
                    }
                    $query->orderBy('seat_number', 'asc');
                }, 'seat.booking' => function ($query) {
                    $query
                        ->where('from', '<=', Carbon::now())
                        ->where('to', '>=', Carbon::now());
                    $query->with('user');
                }])
                ->get()]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],

        ]);
        $room = new Room;
        $room->name = $request->name;

        $room->save();
        return back()->with('success', 'You stored the room successfully');
    }
}
