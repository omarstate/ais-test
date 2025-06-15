<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\QueryService;


class AisQueryController extends Controller
{

    private const TIMEOUT_SECONDS = 90; // Increase timeout to 90 seconds

    private $queryService;

    public function __construct(QueryService $queryService) {
        $this->queryService = $queryService;
    }
    
    public function query(Request $request)
    {
        
            // Get the query data
            $queryString = $this->queryService->getData($request);      
            // Store last search values in session if provided
            if ($request->has('last_search')) {
                $lastSearch = $this->queryService->lastSearch($request);
            }
            // Check if session is valid
            $this->queryService->manageSession($request);
            // Add token to the query if it's not already there
            $this->queryService->addTokenToQuery($queryString);
            
            // Set maximum execution time
            set_time_limit(self::TIMEOUT_SECONDS);
            
            // Send the request to the AIS server with timeout
            return $this->queryService->handleResponse($queryString);
    
        }
} 