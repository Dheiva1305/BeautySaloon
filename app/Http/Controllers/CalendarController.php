<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Beautician;

class CalendarController extends Controller
{
    public function index(Request $request){
        $beauticians = Beautician::get();
        return view('calendar',compact('beauticians'));
    }
    public function store(Request $request){
        $existingBooking = Booking::where('beautician_id', $request->beautician)
        ->where('date', $request->date)
        ->where('slot', $request->slot)
        ->first();

        if ($existingBooking) {
            return response()->json(['error' => 'This beautician is already booked this.'], 400);
        }

        $booking = new Booking;
        $booking->name = $request->name;
        $booking->phone = $request->phone;
        $booking->date = $request->date;
        $booking->slot = $request->slot;
        $booking->beautician_id = $request->beautician;
        $booking->save();

        return response()->json(['success' => 'Booking saved successfully']);
    }
}
