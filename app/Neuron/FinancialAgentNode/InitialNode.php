<?php

declare(strict_types=1);

namespace App\Neuron\FinancialAgentNode;

use Illuminate\Support\Facades\Log;
use NeuronAI\Workflow\Node;
use NeuronAI\Workflow\StartEvent;
use NeuronAI\Workflow\StopEvent;
use NeuronAI\Workflow\WorkflowState;
use App\Neuron\FinancialAgent;
use App\Neuron\FinancialAgentRag;
use Illuminate\Support\Facades\Auth;
use NeuronAI\Chat\Messages\UserMessage;

class InitialNode extends Node
{
    /**
     * Implement the Node's logic
     */
    public function __invoke(StartEvent $event, WorkflowState $state): StopEvent
    {
        try {
            $userId = Auth::user()->id;
            Log::info("first node invoked by $userId");
            // Get user question

            //Talk to agent
            $response = FinancialAgentRag::make()->chat(
                new UserMessage("Dimmi a quanto ammontano le mie entrate di Dicembre e quanti documenti sono presenti.")
            );

            Log::info('agent initial node', [
                'response' => $response
            ]);
            $state->set('response', $response->getContent());

            return new StopEvent();
        } catch (\Throwable $e) {
            Log::error("Errore nel nodo InitialNode: " . $e->getMessage());
            $state->set('final_response', "Mi dispiace, si è verificato un errore tecnico.");
        } finally {
            return new StopEvent();
        }
    }
}
