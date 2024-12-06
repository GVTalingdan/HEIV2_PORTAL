<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HeisAcct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login logic
    public function login(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'hei_username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        Log::info('Login attempt for ' . $request->hei_username);

        // Attempt to authenticate the user based on HEI Username
        $heiAcct = HeisAcct::where('hei_username', $request->hei_username)->first();


        // Check if the user exists
        if (!$heiAcct) {
            Log::error('User not found for HEI Username: ' . $request->hei_username);
            return back()->withErrors([
                'credentials' => 'The provided credentials do not match our records.',
            ]);
        }


        if (md5($request->password) === $heiAcct->hei_password) {
            Log::info('Login successful for HEI Username: ' . $request->hei_username);
            Session(['hei_name' => $heiAcct->hei_name]);
            Auth::guard('hei')->login($heiAcct);
            // Pass the hei_name to the homepage (dashboard) view
            return redirect()->route('homepage_layout.layout')->with('hei_name', $heiAcct->hei_name);
        }

        // If password doesn't match
        Log::error("Password mismatch for HEI Username: " . $request->hei_username);
        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
    }
}
