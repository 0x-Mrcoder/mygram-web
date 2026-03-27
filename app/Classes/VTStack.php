<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VTStack
{
    /**
     * The base URL for the VTStack API.
     *
     * @var string
     */
    protected $baseUrl = 'https://api.vtstack.com.ng/api';

    /**
     * The API key for authentication.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Create a new VTStack instance.
     *
     * @return void
     */
    public function __construct()
    {
        $setting = \App\Models\Setting::first();
        $this->apiKey = $setting->vtstack_api_key ?? env('VTSTACK_API_KEY');
        
        if (empty($this->apiKey)) {
            Log::error('VTStack API Key is missing');
        }
    }

    /**
     * Get the HTTP client with authentication headers.
     *
     * @return \Illuminate\Http\Client\PendingRequest
     */
    protected function client()
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);
    }

    /**
     * Create a Virtual Account.
     *
     * @param array $data
     * @return array
     */
    public function createVirtualAccount($data)
    {
        try {
            Log::info('VTStack: Creating Virtual Account', ['data' => $data]);
            
            $response = $this->client()->post($this->baseUrl . '/virtual-accounts', $data);
            
            Log::info('VTStack: Raw Response', ['body' => $response->body()]);
            
            return $response->json();
        } catch (\Exception $e) {
            Log::error('VTStack: Create Account Exception', ['message' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Fetch Account Balance.
     *
     * @param string $accountNumber
     * @return array
     */
    public function fetchBalance($accountNumber)
    {
        $response = $this->client()->get($this->baseUrl . '/virtual-accounts/' . $accountNumber . '/balance');
        return $response->json();
    }
}
