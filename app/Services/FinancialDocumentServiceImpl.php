<?php

namespace App\Services;

use App\Http\Requests\FinancialDocumentRequest;
use App\Models\FinancialDocument;
use App\Models\FinancialEntries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\FinancialAgentService;
use App\Services\interface\FinancialDocumentService;

class FinancialDocumentServiceImpl implements FinancialDocumentService
{
    public $financialAgentService;
    public function __construct(FinancialAgentService $financialAgentService)
    {
        $this->financialAgentService = $financialAgentService;
    }

    public function store(FinancialDocumentRequest | array $request)
    {
        $user = Auth::user();

        // Create financial docuemnt
        $newDoc = FinancialDocument::create([
            'user_id' => $user->id,
            'period_start' => $request->period_start,
            'period_end' => $request->period_end,
            'notes' => $request->notes ?? null,
        ]);

        $entries = $request->entries;

        // Create entries for financial document
        foreach ($entries as $entry) {
            FinancialEntries::create([
                'financial_document_id' => $newDoc->id,
                'title' => $entry['title'],
                'description' => $entry['description'] ?? null,
                'date' => $entry['date'],
                'amount' => $entry['amount'],
                'type' => $entry['type'],
                'currency' => $entry['currency']
            ]);
        }

        $newDoc->load('financialEntries');

        // Insert document into rag
        $this->financialAgentService->loadDocumentIntoRag($newDoc, $newDoc->financialEntries, $user);

        return $newDoc;
    }
}
