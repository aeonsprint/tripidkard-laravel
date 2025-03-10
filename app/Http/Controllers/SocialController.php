<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectGoogle(Request $request)
    {
        $event = $request->query('event', null); // Kunin ang event, default ay null
        session(['event' => $event]); // I-save sa session

        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request)
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $event = session('event'); // Kunin ang event mula sa session

            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                // Find user by email if google_id is not found
                $user = User::where('email', $google_user->getEmail())->first();

                if (!$user) {
                    // Extract first and last name
                    $fullName = explode(' ', $google_user->getName(), 2);
                    $firstName = $fullName[0] ?? 'Unknown';
                    $lastName = $fullName[1] ?? 'User';

                    $user = User::create([
                        'fname' => $firstName,
                        'lname' => $lastName,
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                        'role' => 'Customer',
                        'status' => 1,
                    ]);
                } else {
                    // If user exists but no google_id, update it
                    $user->update(['google_id' => $google_user->getId()]);
                }
            }

            Auth::login($user);

            // Redirect based on event
            return $event && in_array($event, ['dcia1', 'dcia2'])
                ? redirect("/dcia?already_registered=$event")
                : redirect("/login");

        } catch (\Throwable $th) {
            return redirect("/");
        }
    }

    public function redirectFacebook(Request $request)
    {
        $event = $request->query('event', null); // Default to null
        session(['event' => $event]); // Save event in session

        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $event = session('event'); // Get event from session

            // Find user by facebook_id
            $user = User::where('facebook_id', $facebook_user->getId())->first();

            if (!$user) {
                // Try to find by email if facebook_id is not found
                $user = User::where('email', $facebook_user->getEmail())->first();

                if (!$user) {
                    // Extract first and last name from full name
                    $fullName = explode(' ', $facebook_user->getName(), 2);
                    $firstName = $fullName[0] ?? 'Unknown';
                    $lastName = $fullName[1] ?? 'User';

                    $user = User::create([
                        'fname' => $firstName,
                        'lname' => $lastName,
                        'email' => $facebook_user->getEmail(),
                        'facebook_id' => $facebook_user->getId(),
                        'role' => 'Customer',
                        'status' => 1,
                    ]);
                } else {
                    // Update user if found but missing facebook_id
                    $user->update(['facebook_id' => $facebook_user->getId()]);
                }
            }

            Auth::login($user);

            // Redirect based on event
            return $event && in_array($event, ['dcia1', 'dcia2'])
                ? redirect("/dcia?already_registered=$event")
                : redirect("/login");

        } catch (\Throwable $th) {
            return redirect("/");
        }
    }
}
