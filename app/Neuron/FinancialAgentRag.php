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

class FinancialAgentRag extends RAG
{
    protected function provider(): AIProviderInterface
    {
        return new OpenAI(
            key: config('services.openai.key'),
            model: config('services.openai.model')
        );
    }

    protected function embeddings(): EmbeddingsProviderInterface
    {
        return new OpenAIEmbeddingsProvider(
            key: config('services.openai.key'),
            model: 'OPENAI_EMBEDDINGS_MODEL' // text-embedding-3-small
        );
    }

    protected function vectorStore(): VectorStoreInterface
    {
        return new FileVectorStore(
            directory: storage_path('vectors/financial_documents'),
            name: 'financial_docs'
        );
    }

    public function addDocumentToVector(FinancialDocument $document, array $relatedEntries, User $user)
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

        $documentForRag = [
            'id' => "doc_{$document->id}",
            'content' => $content,
            'metadata' => [
                'user_id' => $user->id,
                'document_id' => $document->id,
            ],
        ];

        $this->addDocuments([$documentForRag]);
    }
}
