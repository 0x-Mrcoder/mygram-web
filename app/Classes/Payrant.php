<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class Payrant
{
    /**
     * The base URL for the Payrant API.
     *
     * @var string
     */
    protected $baseUrl = 'https://api-core.payrant.com';

    /**
     * The API key for authentication.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Create a new Payrant instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiKey = env('PAYRANT_API_KEY');
        if (empty($this->apiKey)) {
            throw new \Exception('Payrant API Key is missing in .env');
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
        // Endpoint: /palmpay/
        $response = $this->client()->post($this->baseUrl . '/palmpay/', $data);
        return $response->json();
    }

    /**
     * Initialize Checkout Transaction.
     *
     * @param array $data
     * @return array
     */
    public function initializeCheckout($data)
    {
        // Endpoint: /transaction/api.php?action=initialize
        $response = $this->client()->post($this->baseUrl . '/transaction/api.php?action=initialize', $data);
        return $response->json();
    }

    /**
     * Verify Checkout Transaction.
     *
     * @param string $reference
     * @return array
     */
    public function verifyCheckout($reference)
    {
        // Endpoint: /transaction/api.php?action=verify
        // Try GET with 'ref' as parameter (matching checkout URL)
        $response = $this->client()->get($this->baseUrl . '/transaction/api.php', [
            'action' => 'verify',
            'ref' => $reference, // Changed from 'reference' to 'ref'
            'reference' => $reference // Keep 'reference' just in case
        ]);
        return $response->json();
    }

    /**
     * Initiate Bank Transfer (Payout).
     *
     * @param array $data
     * @return array
     */
    public function transfer($data)
    {
        // Endpoint: /payout/transfer/
        $response = $this->client()->post($this->baseUrl . '/payout/transfer/', $data);
        return $response->json();
    }

    /**
     * Validate Account Name.
     *
     * @param string $bankCode
     * @param string $accountNumber
     * @return array
     */
    public function validateAccount($bankCode, $accountNumber)
    {
        // Endpoint: /payout/validate_account/
        $response = $this->client()->post($this->baseUrl . '/payout/validate_account/', [
            'bank_code' => $bankCode,
            'account_number' => $accountNumber
        ]);
        return $response->json();
    }

    /**
     * Get Available Banks.
     *
     * @return array
     */
    public function getBanks()
    {
        // Endpoint: /payout/banks_list/
        $response = $this->client()->get($this->baseUrl . '/payout/banks_list/');
        return $response->json();
    }
}
