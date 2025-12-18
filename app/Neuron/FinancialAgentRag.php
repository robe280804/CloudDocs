<?php

declare(strict_types=1);

namespace App\Neuron;

use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\RAG\Embeddings\EmbeddingsProviderInterface;
use NeuronAI\RAG\RAG;
use NeuronAI\Providers\OpenAI\OpenAI;
use NeuronAI\RAG\Embeddings\OpenAIEmbeddingsProvider;
use NeuronAI\RAG\VectorStore\QdrantVectorStore;
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

    // Use a vectorstore where i can use metadata to filter document 
    protected function vectorStore(): VectorStoreInterface
    {
        return new QdrantVectorStore(
            collectionUrl: config('services.qdrant.url'),
            key: config('services.qdrant.key')
        );
    }
}
