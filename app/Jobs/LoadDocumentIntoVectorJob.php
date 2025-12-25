<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Neuron\FinancialAgentRag;
use Exception;
use Illuminate\Support\Facades\Log;

class LoadDocumentIntoVectorJob implements ShouldQueue
{
    use Queueable;

    protected array $documents;
    /**
     * Create a new job instance.
     */
    public function __construct(array $documents)
    {
        $this->documents = $documents;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        FinancialAgentRag::make()->addDocuments($this->documents, 1);
        Log::info("Documents insert into RAG", [
            'doc' => $this->documents
        ]);
    }
}
