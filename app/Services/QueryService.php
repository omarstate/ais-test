<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class QueryService {

     // Define constants inside the class to match AuthController
     private const DEVICE_NAME = "JDE";
     private const ENVIRONMENT = "JPY920";
     private const TIMEOUT_SECONDS = 90; // Increase timeout to 90 seconds


     

    public function getData(Request $request) {
        $queryString = $request->input('query');
        $queryData = json_decode($queryString, true);
        return $queryData;
    }

    public function lastSearch(Request $request) {
        $lastSearch = $request->input('last_search');
        return $lastSearch;
    }

    public function manageSession(Request $request){
        if (!session('token') && session('persistent_token')) {
            // If we have a persistent token, restore the data
            session(['token' => session('persistent_token')]);
        }
        
        if (!session('token')) {
            return redirect()->back()->with('error', 'No authentication token available. Please log in again.');
        }
        
    }

    public function addTokenToQuery($queryString){
        // Add token to the query if it's not already there
        if (!isset($queryString['token'])) {
            $queryString['token'] = session('token');
        }
    }

    public function handleResponse($queryString){
        try {
        $response = Http::timeout(self::TIMEOUT_SECONDS - 5) // Leave 5 seconds buffer
                ->post(env('JDE_DATA_SERVICE'), $queryString);

            if ($response->successful()) {
                $result = $response->json();
                
                // Check if result is empty
                if (empty($result)) {
                    return redirect()->back()->with([
                        'warning' => 'Query executed successfully but returned no data',
                        'query_result' => ['message' => 'No data returned']
                    ]);
                }
                
                return redirect()->back()->with([
                    'success' => 'Query executed successfully',
                    'query_result' => $result
                ]);
            } else {
                return redirect()->back()->with('error', 'Query failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Server error: ' . $e->getMessage());
        }
    }
}

?>