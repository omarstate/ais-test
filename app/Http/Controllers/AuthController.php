<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private const DEVICE_NAME = "JDE";
    private const ENVIRONMENT = "JPY920";

    public function auth(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            // Prepare the authentication request
            $authData = [
                'deviceName' => self::DEVICE_NAME,
                'environment' => self::ENVIRONMENT,
                'username' => $request->username,
                'password' => $request->password,
            ];

            // Send the authentication request to the JDE server
            $response = Http::post('http://jdeweb.epxlogistics.com:5000/jderest/tokenrequest', $authData);
            $responseBody = $response->json();

            if ($response->successful() && isset($responseBody['userInfo']['token'])) {
                // Store the token and full response in the session
                session([
                    'token' => $responseBody['userInfo']['token'],
                    'fullResponse' => $responseBody,
                    'persistent_token' => $responseBody['userInfo']['token'],
                    'persistent_fullResponse' => $responseBody
                ]);

                return redirect()->intended('/dashboard')->with('success', 'Successfully logged in');
            } else {
                return back()
                    ->withInput($request->only('username'))
                    ->with('error', 'Invalid username or password');
            }
        } catch (\Exception $e) {
            Log::error('Authentication error: ' . $e->getMessage());
            return back()
                ->withInput($request->only('username'))
                ->with('error', 'An error occurred during login');
        }
    }

    public function logout(Request $request)
    {
        // Clear all session data
        $request->session()->flush();
        
        // Return a view that will clear sessionStorage and redirect
        return view('auth.logout');
    }
}
