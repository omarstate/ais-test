<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



class AuthenticationService
{
    private const DEVICE_NAME = "JDE";
    private const ENVIRONMENT = "JPY920";

    //Authenticate the user
    public function authenticate(string $username, string $password): Response
    {
        return Http::post(env('JDE_TOKEN_REQUEST'), [
            'deviceName' => self::DEVICE_NAME,
            'environment' => self::ENVIRONMENT,
            'username' => $username,
            'password' => $password,
        ]);

    }

    //Store the session data in the session
    public function storeSession(array $responseBody): void
{
    $token = $responseBody['userInfo']['token'] ?? null;

    if ($token) {
        session([
            'token' => $token,
            'fullResponse' => $responseBody,
            'persistent_token' => $token,
            'persistent_fullResponse' => $responseBody,
        ]);
    }
}


public function handleFailure(Request $request, string $message = 'Invalid username or password'): RedirectResponse
{
    return back()
        ->withInput($request->only('username'))
        ->with('error', $message);
}

}


