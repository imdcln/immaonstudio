<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\ReservationStatus;
use App\Models\ReservationType;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function getAvailableTimes(Request $request)
    {
        $date = $request->query('date'); // Format: YYYY-MM-DD

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        // 🧩 Fetch reservations that are ACCEPTED or PENDING for that date
        $bookedDetails = ReservationDetail::whereHas('reservation', function ($query) {
            $query->whereIn('status_id', [1, 2]); // Example: 1 = Pending, 2 = Accepted
        })
        ->whereDate('reservation_date', $date)
        ->get(['start', 'end']);

        // 🕐 Format to match the frontend time format (e.g., "01:00 PM")
        $bookedTimes = $bookedDetails->map(function ($detail) {
            return [
                'start' => Carbon::parse($detail->start)->format('h:i A'),
                'end'   => Carbon::parse($detail->end)->format('h:i A'),
            ];
        });

        return response()->json([
            'bookedTimes' => $bookedTimes,
        ]);
    }

    /**
     * Store a new reservation and detail.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start' => 'required',
            'end' => 'required',
            'activity' => 'required|string',
            'userType' => 'required|string',
            'totalParticipants' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Find the "Pending" status
        $pendingStatus = ReservationStatus::where('status', 'Pending')->first();
        if (!$pendingStatus) {
            return response()->json(['error' => 'Missing Pending status in DB'], 500);
        }

        // Create the reservation (Pending)
        $reservation = Reservation::create([
            'user_id' => $user->id,
            'status_id' => $pendingStatus->id,
        ]);

        // Create the detail entry
        ReservationDetail::create([
            'reservation_id' => $reservation->id,
            'reservation_date' => $validated['date'],
            'start' => $validated['start'],
            'end' => $validated['end'],
            'total_participants' => $validated['totalParticipants'],
            'descriptions' => $validated['description'],
        ]);

        session()->flash('success', 'Reservation submitted and awaiting approval!');

        return response()->json([
            'success' => true,
            'redirect' => route('home')
        ]);
    }
}
