<?php

namespace App\Services;

use App\Neuron\FinancialAgentRag;
use App\Models\FinancialDocument;
use App\Models\User;
use App\Neuron\FinancialAgent;
use Illuminate\Support\Collection;
use NeuronAI\RAG\DataLoader\StringDataLoader;
use Illuminate\Support\Facades\Log;
use NeuronAI\Chat\Messages\UserMessage;

class FinancialAgentService
{
    public function loadDocumentIntoRag(FinancialDocument $document, Collection $relatedEntries, User $user)
    {
        $contents = $this->convertDocumentToString($document, $relatedEntries, $user);

        $documents = StringDataLoader::for($contents)->getDocuments();
        Log::info("Documents to insert into RAG", [
            'doc' => $documents
        ]);

        FinancialAgentRag::make()->addDocuments($documents, 1);
    }

    public function chat(ChatRequest $request)
    {
        $response = FinancialAgent::make()->chat(
            new UserMessage()
        );
    }
    private function convertDocumentToString(FinancialDocument $document, Collection $relatedEntries, User $user)
    {
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
        return $content;
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
