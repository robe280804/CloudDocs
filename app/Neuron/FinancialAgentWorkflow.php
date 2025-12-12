<?php

declare(strict_types=1);

namespace App\Neuron;

use NeuronAI\Workflow\Workflow;
use App\Neuron\FinancialAgentNode\InitialNode;

class FinancialAgentWorkflow extends Workflow
{
    protected function nodes(): array
    {
        return [
            new InitialNode(),
        ];
    }
}
