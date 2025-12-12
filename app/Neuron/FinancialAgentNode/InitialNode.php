<?php

declare(strict_types=1);

namespace App\Neuron\FinancialAgentNode;

use NeuronAI\Workflow\Node;
use NeuronAI\Workflow\StartEvent;
use NeuronAI\Workflow\StopEvent;
use NeuronAI\Workflow\WorkflowState;

class InitialNode extends Node
{
    /**
     * Implement the Node's logic
     */
    public function __invoke(StartEvent $event, WorkflowState $state): StopEvent
    {
        // ...

        return new StopEvent();
    }
}
