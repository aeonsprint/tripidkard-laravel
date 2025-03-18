<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogleUser(Request $request)
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->orWhere('email', $google_user->getEmail())->first();

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
                    'password' => bcrypt(str()->random(16)), // Generate random password
                    'role' => 'Customer',
                    'status' => 1,
                ]);
            } else {
                // If user exists but no google_id, update it
                if (!$user->google_id) {
                    $user->update(['google_id' => $google_user->getId()]);
                }

                // If user exists but is NOT a Customer, deny access
                if ($user->role !== 'Customer') {
                    return redirect('/login')->withErrors(['general' => 'Only Customers can log in using Google.']);
                }
            }

            Auth::login($user);

            return redirect('/customer/profile/');


        } catch (\Throwable $th) {
            return redirect('/login')->withErrors(['general' => 'Google login failed. Please try again.']);
        }
    }

    public function redirectFacebook(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebookUser()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $user = User::where('facebook_id', $facebook_user->getId())->orWhere('email', $facebook_user->getEmail())->first();

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
                    'password' => bcrypt(str()->random(16)), // Generate random password
                    'role' => 'Customer',
                    'status' => 1,
                ]);
            } else {
                // Update user if found but missing facebook_id
                if (!$user->facebook_id) {
                    $user->update(['facebook_id' => $facebook_user->getId()]);
                }

                // If user exists but is NOT a Customer, deny access
                if ($user->role !== 'Customer') {
                    return redirect('/login')->withErrors(['general' => 'Only Customers can log in using Facebook.']);
                }
            }

            Auth::login($user);
            return redirect('/customer/profile/');

        } catch (\Throwable $th) {
            return redirect('/login')->withErrors(['general' => 'Facebook login failed. Please try again.']);
        }
    }
}
