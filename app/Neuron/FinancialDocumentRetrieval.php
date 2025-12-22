<?php

namespace App\Neuron;

use NeuronAI\Chat\Messages\Message;
use NeuronAI\RAG\Embeddings\EmbeddingsProviderInterface;
use NeuronAI\RAG\VectorStore\VectorStoreInterface;
use NeuronAI\RAG\Retrieval\RetrievalInterface;

class FinancialDocumentRetrieval implements RetrievalInterface
{
    public function __construct(
        private readonly VectorStoreInterface $vectorStore,
        private readonly EmbeddingsProviderInterface $embeddingProvider,
        protected string $userId
    ) {}

    public function retrieve(Message $query): array
    {
        return $this->vectorStore->similaritySearch(
            $this->embeddingProvider->embedText($query->getContent())
        );
    }
}
