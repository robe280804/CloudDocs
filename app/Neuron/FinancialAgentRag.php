<?php

namespace App\Neuron;

use Illuminate\Support\Facades\Auth;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\RAG\Embeddings\EmbeddingsProviderInterface;
use NeuronAI\RAG\RAG;
use NeuronAI\RAG\VectorStore\QdrantVectorStore;
use NeuronAI\RAG\VectorStore\VectorStoreInterface;
use NeuronAI\Providers\Ollama\Ollama;
use App\Neuron\QdrantCustomVectorStore;
use NeuronAI\RAG\Retrieval\SimilarityRetrieval;
use NeuronAI\RAG\Embeddings\OllamaEmbeddingsProvider;
use NeuronAI\RAG\Retrieval\RetrievalInterface;

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

    protected function retrieval(): RetrievalInterface
    {
        $store =  new QdrantCustomVectorStore(
            collectionUrl: config('services.qdrant.url'),
            key: config('services.qdrant.key')
        );

        $store->setUser(Auth::user()->id);

        return new SimilarityRetrieval(
            $store,
            $this->embeddings()
        );
    }
}
