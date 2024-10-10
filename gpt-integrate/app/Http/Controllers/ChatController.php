<?php

namespace App\Http\Controllers;

use App\Services\AIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $AIService;

    public function __construct(AIService $aIService)
    {
        $this->AIService = $aIService;
    }

    public function sendChat(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $prompt = $request->input('prompt');

        $response = $this->AIService->askGemini($prompt);

        return response()->json($response);
    }
}
