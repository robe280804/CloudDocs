<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FinancialAgentService;
use App\Http\Requests\ChatRequest;

class FinancialAgentController extends Controller
{
    public $financialAgentService;

    public function __construct(FinancialAgentService $financialAgentService)
    {
        $this->financialAgentService = $financialAgentService;
    }
    public function chat(ChatRequest $request)
    {
        $agentResponse = $this->financialAgentService->chat($request);
        return response()->json([
            'response' => $agentResponse
        ]);
    }
}
