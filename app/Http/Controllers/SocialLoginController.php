<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

                // Create new user
                $user = User::create([
                    'fname' => $firstName,
                    'lname' => $lastName,
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'role' => 'Customer',
                    'status' => 1,
                ]);

                // Insert into customers table
                Customer::create([
                    'user_id' => $user->id,
                    'customer_card_num' => $this->generateCardCode(),
                ]);
            } else {
                if (!$user->google_id) {
                    $user->update(['google_id' => $google_user->getId()]);
                }

                if ($user->role !== 'Customer') {
                    return redirect('/login')->withErrors(['general' => 'Only Customers can log in using Google.']);
                }

                // If user exists but is NOT in customers, insert them
                $customer = Customer::where('user_id', $user->id)->first();
                if (!$customer) {
                    Customer::create([
                        'user_id' => $user->id,
                        'customer_card_num' => $this->generateCardCode(),
                    ]);
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
                // Extract first and last name
                $fullName = explode(' ', $facebook_user->getName(), 2);
                $firstName = $fullName[0] ?? 'Unknown';
                $lastName = $fullName[1] ?? 'User';

                // Create new user
                $user = User::create([
                    'fname' => $firstName,
                    'lname' => $lastName,
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' => $facebook_user->getId(),
                    'role' => 'Customer',
                    'status' => 1,
                ]);

                // Insert into customers table
                Customer::create([
                    'user_id' => $user->id,
                    'customer_card_num' => $this->generateCardCode(),
                ]);
            } else {
                if (!$user->facebook_id) {
                    $user->update(['facebook_id' => $facebook_user->getId()]);
                }

                if ($user->role !== 'Customer') {
                    return redirect('/login')->withErrors(['general' => 'Only Customers can log in using Facebook.']);
                }

                // If user exists but is NOT in customers, insert them
                $customer = Customer::where('user_id', $user->id)->first();
                if (!$customer) {
                    Customer::create([
                        'user_id' => $user->id,
                        'customer_card_num' => $this->generateCardCode(),
                    ]);
                }
            }

            Auth::login($user);
            return redirect('/customer/profile/');

        } catch (\Throwable $th) {
            return redirect('/login')->withErrors(['general' => 'Facebook login failed. Please try again.']);
        }
    }

    /**
     * Generate unique customer card code.
     */
    private function generateCardCode()
    {
        $currentYear = date('Y');
        $lastCardCode = Customer::where('customer_card_num', 'like', $currentYear . '-0C-%')
            ->latest('customer_card_num')
            ->value('customer_card_num');

        $lastSerialNumber = 1;
        if ($lastCardCode) {
            $lastSerialNumber = intval(substr($lastCardCode, -7)) + 1;
        }

        return $currentYear . '-0C-' . str_pad($lastSerialNumber, 7, '0', STR_PAD_LEFT);
    }
}
