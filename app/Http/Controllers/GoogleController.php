<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            // dd($user);
            $finduser = Customer::where('google_id', $user->id)->first();
            // dd($finduser);
            if($finduser){
       
                Auth::guard('customer')->login($finduser);
      
                return redirect()->intended('customer');
       
            }else{
                $newUser = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456'),
                    'avatar' => $user->avatar,
                ]);
      
                Auth::guard('customer')->login($newUser);
      
                return redirect()->intended('customer');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
