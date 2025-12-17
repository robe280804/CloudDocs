<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FinancialAgentService;

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
    }
}
