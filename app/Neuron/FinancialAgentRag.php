<?php

declare(strict_types=1);

namespace App\Neuron;

use App\Models\FinancialDocument;
use App\Models\FinancialEntries;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\RAG\Embeddings\EmbeddingsProviderInterface;
use NeuronAI\RAG\RAG;
use NeuronAI\Providers\OpenAI\OpenAI;
use NeuronAI\RAG\Embeddings\OpenAIEmbeddingsProvider;
use NeuronAI\RAG\VectorStore\VectorStoreInterface;
use NeuronAI\RAG\VectorStore\FileVectorStore;
use App\Models\User;
use Illuminate\Support\Collection;
use NeuronAI\Providers\Ollama\Ollama;
use NeuronAI\RAG\Document;
use NeuronAI\RAG\DataLoader\StringDataLoader;
use NeuronAI\RAG\Embeddings\OllamaEmbeddingsProvider;

class FinancialAgentRag extends RAG
{
    protected function provider(): AIProviderInterface
    {
        return new Ollama(
            url: config('services.ollamma.url'),
            model: config('services.ollamma.model')
        );
    }

    protected function embeddings(): EmbeddingsProviderInterface
    {
        return new OllamaEmbeddingsProvider(
            url: config('services.ollamma.url'),
            model: 'nomic-embed-text'
        );
    }

    protected function vectorStore(): VectorStoreInterface
    {
        return new FileVectorStore(
            directory: storage_path('vectors/financial_documents'),
            name: 'financial_docs'
        );
    }

    public function addDocumentToVector(FinancialDocument $document, Collection $relatedEntries, User $user)
    {
        $contents = ["Financial Document from {$document->period_start?->toDateString()} to {$document->period_end->toDateString()}\n"];
        $contents[] = "Notes: " . ($document->notes ?? 'N/A') . "\n\n";
        $contents[] = "Entries: \n";

        foreach ($relatedEntries as $entry) {
            $contents[] = sprintf(
                "- [%s] %s | %s | %s | %.2f %s\n",
                $entry->date?->toDateString(),
                strtoupper($entry->type),
                $entry->title,
                $entry->description ?: 'No description',
                $entry->amount,
                $entry->currency
            );
        }
        return $contents;
    }
}
