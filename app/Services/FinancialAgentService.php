<?php

namespace App\Services;

use App\Neuron\FinancialAgentRag;
use App\Models\FinancialDocument;
use App\Models\User;
use App\Neuron\FinancialAgent;
use App\Neuron\FinancialAgentWorkflow;
use Illuminate\Support\Collection;
use NeuronAI\RAG\DataLoader\StringDataLoader;
use Illuminate\Support\Facades\Log;
use NeuronAI\Chat\Messages\UserMessage;
use App\Http\Requests\ChatRequest;

class FinancialAgentService
{
    /**
     * payload_schema {
     *  'user_id'
     *  'period_end'
     *  'document_id'
     *  'period_start'
     *  'text'
     * }
     */


    public function loadDocumentIntoRag(FinancialDocument $document, Collection $relatedEntries, User $user)
    {
        ini_set('max_execution_time', 1800);

        $documents = $this->convertDocumentoForRag($document, $relatedEntries, $user);

        // Insert into Qdrant vector
        FinancialAgentRag::make()->addDocuments($documents, 1);
        Log::info("Documents insert into RAG", [
            'doc' => $documents
        ]);
    }

    public function chat(ChatRequest $request)
    {
        ini_set('max_execution_time', 3600);
        $response = FinancialAgentWorkflow::make()->start()->getResult();

        return $response->get('response');
    }

    private function convertDocumentoForRag(FinancialDocument $document, Collection $relatedEntries, User $user)
    {
        // Create content
        $content = "Financial Document from {$document->period_start?->toDateString()} to {$document->period_end->toDateString()}\n";
        $content .= "Notes: " . ($document->notes ?? 'N/A') . "\n\n";
        $content .= "Entries: \n";

        foreach ($relatedEntries as $entry) {
            $content .= sprintf(
                "- [%s] %s | %s | %s | %.2f %s\n",
                $entry->date?->toDateString(),
                strtoupper($entry->type),
                $entry->title,
                $entry->description ?: 'No description',
                $entry->amount,
                $entry->currency
            );
        }
        //Log::info("content: $content");

        // Convert into NeuronAI\\RAG\\Document
        $documents = StringDataLoader::for($content)->getDocuments();
        /*Log::info("documents", [
            'doc' => $documents
        ]);*/

        // Adding metadata
        foreach ($documents as $doc) {
            $doc->addMetadata('user_id', $user->id);
            $doc->addMetadata('document_id', $document->id);
            $doc->addMetadata('period_start', $document->period_start?->toISOString());
            $doc->addMetadata('period_end', $document->period_end?->toISOString());
        }

        /*Log::info("documents with metadata", [
            'doc' => $documents
        ]);*/
        return $documents;
    }

    public function testStringDataLoaderIntoRag()
    {
        $contents = [
            "Hi, I'm Roberto Sodini. I am a full stack developer.",
            "I work in Net7 with Laravel and other stuff"
        ];

        foreach ($contents as $text) {
            $documents = StringDataLoader::for($text)->getDocuments();

            FinancialAgentRag::make()->addDocuments($documents);
            Log::info("insert document into rag", [
                'document' => $documents
            ]);
        }
    }
}
