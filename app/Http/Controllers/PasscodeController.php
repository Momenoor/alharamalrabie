<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasscodeController extends Controller
{
    public function showForm()
    {
        return view('passcode.form');
    }

    // Verify the passcode and store it in the session
    public function verifyPasscode(Request $request)
    {
        $request->validate([
            'passcode' => 'required|string'
        ]);

        // Define the correct passcode (you can replace this with logic to check in the database)
        $correctPasscode = env('PASSKEY');  // Example passcode

        // Check if the passcode matches
        if ($request->passcode === $correctPasscode) {
            // Store passcode verification in the session
            $request->session()->put('passcode_verified', true);

            return redirect()->intended('/all'); // Redirect to the intended route after login
        }

        // If the passcode is incorrect, return back with an error
        return back()->withErrors(['passcode' => 'Incorrect passcode.']);
    }
}
