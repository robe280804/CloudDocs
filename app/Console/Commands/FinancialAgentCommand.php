<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use NeuronAI\Chat\Messages\UserMessage;
use App\Neuron\FinancialAgent;

class FinancialAgentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:financial-agent-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $resposne = FinancialAgent::make()->chat(
            new UserMessage('Hi, who are you?')
        );

        echo $resposne->getContent();
    }
}
