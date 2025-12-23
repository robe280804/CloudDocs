<?php


declare(strict_types=1);

namespace App\Neuron;

use GuzzleHttp\RequestOptions;
use NeuronAI\RAG\VectorStore\QdrantVectorStore;
use NeuronAI\RAG\Document;

class QdrantCustomVectorStore extends QdrantVectorStore
{
    protected ?string $currentUserId = null;

    public function setUser(string $userId): self
    {
        $this->currentUserId = $userId;
        return $this;
    }

    public function similaritySearch(array $embedding): iterable
    {
        // If userid = null, don't search
        if (!$this->currentUserId) {
            return [];
        }

        $response = $this->client()->post('points/search', [
            RequestOptions::JSON => [
                'vector' => $embedding,
                'limit' => $this->topK,
                'with_payload' => true,
                'with_vector' => true,
                'filter' => [
                    'must' => [
                        [
                            'key' => 'user_id',
                            'match' => ['value' => $this->currentUserId]
                        ]
                    ]
                ]
            ]
        ])->getBody()->getContents();

        $response = json_decode($response, true);

        return array_map(function (array $item): Document {
            $document = new Document($item['payload']['content']);
            $document->id = $item['id'];
            $document->sourceType = $item['payload']['sourceType'] ?? '';
            $document->sourceName = $item['payload']['sourceName'] ?? '';

            foreach ($item['payload'] as $name => $value) {
                $document->addMetadata($name, $value);
            }
            return $document;
        }, $response['result']);
    }
}
