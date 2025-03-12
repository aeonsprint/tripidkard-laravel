<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Merchant;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // GET: Kunin ang mga likes ng authenticated user
    public function index()
    {
        $bookmarks = Like::where('user_id', Auth::id())->get(['merchant_id']);
        return response()->json($bookmarks);
    }

    public function count()
{
    $user = request()->user();

    // Kunin ang merchant record gamit ang user_id
    $merchant = Merchant::where('user_id', $user->id)->first();

    if (!$merchant) {
        return response()->json(['error' => 'Merchant not found'], 404);
    }

    // I-filter ang bookmarks gamit ang merchant_id
    $totalLikes = Like::where('merchant_id', $merchant->id)->count();

    return response()->json(['totalLikes' => $totalLikes]);
}

    // POST: Mag-like ng merchant
    public function store(Request $request)
    {
        $request->validate(['merchant_id' => 'required|exists:merchants,id']);

        Like::firstOrCreate([
            'merchant_id' => $request->merchant_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Bookmark added'], 201);
    }

    // DELETE: Mag-unlike ng merchant
    public function destroy($merchantId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Like::where('user_id', $user->id)->where('merchant_id', $merchantId)->delete();

        return response()->json(['message' => 'Unliked successfully']);
    }
}
