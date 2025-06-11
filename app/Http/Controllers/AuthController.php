<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\AuthenticationService;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(Request $request)
    {
        try {
            // Use the authentication service
            $response = $this->authService->authenticate($request->username, $request->password);
            $responseBody = $response->json();

            if ($response->successful() && isset($responseBody['userInfo']['token'])) {
                $this->authService->storeSession($responseBody);
                return redirect()->intended('/dashboard')->with('success', 'Successfully logged in.');
                
            } else {
                return $this->authService->handleFailure($request, 'Invalid username or password');
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
