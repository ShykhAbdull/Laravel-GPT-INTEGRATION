<?php

namespace App\Services;

use GuzzleHttp\Client;

class AIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY'); 
        $this->client = new Client();
    }

    public function askGemini($text)
    {
        $response_URI = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent';

        try {
            $response = $this->client->post($response_URI, [
                'headers' => [
                    'Authorization' => 'Bearer' ,
                    'Content-Type' => 'application/json',
                ],
                'query' => [
                    'key' => $this->apiKey
                ],
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $text
                                ]
                            ]
                        ]
                    ]
                ],
            ]);

            return json_decode($response->getBody(), true);
        }


         catch (\Exception $e) {
            \Log::error('An unexpected error occurred: ' . $e->getMessage());
            return ['error' => 'An error occurred: ' . $e->getMessage()];
        }
    }
}
