<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    // Define constants inside the class
    private const DEVICE_NAME = "JDE";
    private const ENVIRONMENT = "JPY920";

    public function auth(Request $request)
    {
        $credentials = $request->only(['username', 'password']);
        $credentials['deviceName'] = self::DEVICE_NAME;
        $credentials['environment'] = self::ENVIRONMENT;

        try {
            $response = Http::post('http://jdeweb.epxlogistics.com:5000/jderest/tokenrequest', $credentials);

            if ($response->successful()) {
                $token = $response->json();
                // Store in regular session
                session(['token' => $token['userInfo']['token']]);
                session(['fullResponse' => $token]);

                // Store in persistent session
                session(['persistent_token' => $token['userInfo']['token']]);
                session(['persistent_fullResponse' => $token]);
                
                // Force session save
                session()->save();

                return redirect('/dashboard')->with([
                    'success' => 'Logged in successfully',
                    'token' => $token['userInfo']['token']
                ]);
            } else {
                return redirect()->route('login')->with('error', 'Login failed: ' . $response->getBody());
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Server error: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        // Clear all session tokens
        session()->forget(['token', 'persistent_token', 'fullResponse', 'persistent_fullResponse']);
        return redirect()->route('login');
    }
}
