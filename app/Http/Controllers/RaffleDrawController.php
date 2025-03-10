<?php

namespace App\Http\Controllers;

use App\Models\RaffleDraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RaffleDrawController extends Controller
{


    public function getRaffleParticipants($raffle_id)
    {
        $participants = RaffleDraw::where('raffle_id', $raffle_id)
            ->join('users', 'raffle_draws.join_id', '=', 'users.id') // Join sa Users table
            ->select([
                DB::raw("CONCAT(users.lname, ', ', users.fname, ' ', COALESCE(users.mname, '')) AS customer_name"),
                DB::raw("raffle_draws.created_at AS joined_at")
            ])
            ->orderBy('raffle_draws.created_at', 'desc')
            ->get();

        return response()->json($participants);
    }

    public function joinRaffle(Request $request)
    {
        $request->validate([
            'raffle_id' => 'required|exists:raffles,id',
        ]);

        $user = $request->user(); // Tamang paraan ng pagkuha ng authenticated user

        // I-check kung naka-join na ang user sa raffle
        $existingEntry = RaffleDraw::where('raffle_id', $request->raffle_id)
            ->where('join_id', $user->id)
            ->first();

        if ($existingEntry) {
            return response()->json(['message' => 'You have already joined this raffle.'], 400);
        }

        // I-save ang entry sa database
        RaffleDraw::create([
            'raffle_id' => $request->raffle_id,
            'join_id' => $user->id,
        ]);

        return response()->json(['message' => 'Successfully joined the raffle!']);
    }
}
