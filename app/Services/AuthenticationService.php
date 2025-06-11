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
        return Http::post('http://jdeweb.epxlogistics.com:5000/jderest/tokenrequest', [
            'deviceName' => self::DEVICE_NAME,
            'environment' => self::ENVIRONMENT,
            'username' => $username,
            'password' => $password,
        ]);

    }

    //Store the session data in the session
    public function storeSession(array $userInfo): void
{
    $token = $userInfo['userInfo']['token'] ?? null;

    if ($token) {
        session([
            'token' => $token,
            'fullResponse' => $userInfo,
            'persistent_token' => $token,
            'persistent_fullResponse' => $userInfo,
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


