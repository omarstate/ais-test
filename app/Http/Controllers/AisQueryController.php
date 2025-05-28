<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AisQueryController extends Controller
{
    // Define constants inside the class to match AuthController
    private const DEVICE_NAME = "JDE";
    private const ENVIRONMENT = "JPY920";
    private const TIMEOUT_SECONDS = 90; // Increase timeout to 90 seconds

    public function query(Request $request)
    {
        try {
            // Get the query data
            $queryString = $request->input('query');            
            // Parse the JSON query
            $queryData = json_decode($queryString, true);
            
            // Store last search values in session if provided
            if ($request->has('last_search')) {
                $lastSearch = json_decode($request->input('last_search'), true);
                session(['last_search' => $lastSearch]);
            }
            
            // Check if JSON was valid
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->with('error', 'Invalid JSON: ' . json_last_error_msg());
            }
            // Make sure we have a token
            if (!session('token') && session('persistent_token')) {
                // If we have a persistent token, restore the data
                session(['token' => session('persistent_token')]);
            }
            
            if (!session('token')) {
                return redirect()->back()->with('error', 'No authentication token available. Please log in again.');
            }
            
            // Add token to the query if it's not already there
            if (!isset($queryData['token'])) {
                $queryData['token'] = session('token');
            }
            // Set maximum execution time
            set_time_limit(self::TIMEOUT_SECONDS);
            
            // Send the request to the AIS server with timeout
            $response = Http::timeout(self::TIMEOUT_SECONDS - 5) // Leave 5 seconds buffer
                ->post('http://jdeweb.epxlogistics.com:5000/jderest/dataservice', $queryData);

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

    public function formservice(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'query' => 'required',
            ]);

            // Get the query data
            $queryString = $request->input('query');            
            // Parse the JSON query
            $queryData = json_decode($queryString, true);
            
            // Check if JSON was valid
            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->with('error', 'Invalid JSON: ' . json_last_error_msg());
            }

            // Only add required constants if they don't exist
            if (!isset($queryData['deviceName'])) {
                $queryData['deviceName'] = self::DEVICE_NAME;
            }
            
            if (!isset($queryData['environment'])) {
                $queryData['environment'] = self::ENVIRONMENT;
            }
            
            // Make sure we have a token
            if (!session('token') && session('persistent_token')) {
                // If we have a persistent token, restore the data
                session(['token' => session('persistent_token')]);
            }
            
            if (!session('token')) {
                return redirect()->back()->with('error', 'No authentication token available. Please log in again.');
            }
            
            // Add token to the query if it's not already there
            if (!isset($queryData['token'])) {
                $queryData['token'] = session('token');
            }

            // Set maximum execution time
            set_time_limit(self::TIMEOUT_SECONDS);
            
            // Send the request to the AIS server with timeout
            $response = Http::timeout(self::TIMEOUT_SECONDS - 5) // Leave 5 seconds buffer
                ->post('http://jdeweb.epxlogistics.com:8002/jderest/v2/formservice', $queryData);

            if ($response->successful()) {
                $result = $response->json();
                
                // Check if result is empty
                if (empty($result)) {
                    return redirect()->back()->with([
                        'warning' => 'Form service executed successfully but returned no data',
                        'query_result' => ['message' => 'No data returned']
                    ]);
                }
                
                return redirect()->back()->with([
                    'success' => 'Form service executed successfully',
                    'query_result' => $result
                ]);
            } else {
                return redirect()->back()->with('error', 'Form service failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Server error: ' . $e->getMessage());
        }
    }
} 