<?php

namespace App\Neuron;

use NeuronAI\Agent;
use NeuronAI\SystemPrompt;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\Ollama\Ollama;


class FinancialAgent extends Agent
{
    protected function provider(): AIProviderInterface
    {
        // return an instance of Anthropic, OpenAI, Gemini, Ollama, etc...
        return new Ollama(
            url: config('services.ollamma.url'),
            model: config('services.ollamma.model')
        );
    }

    public function instructions(): string
    {
        return (string) new SystemPrompt(
            background: [
                "You are a friendly and professional AI agent specialized in personal finance management.",
                "You have access to users' financial documents and financial entries, including incomes, expenses, and historical spending data.",
                "Your task is to provide clear analysis, statistics, and financial forecasts.",
                "You should always be accurate, concise, and user-friendly."
            ],
            steps: [
                "Analyze the user's financial documents and financial entries and extract relevant data.",
                "Calculate total income, expenses, and trends for the requested period.",
                "Provide statistical forecasts for future spending based on historical data.",
                "Answer user questions in natural, understandable language.",
                "Always validate dates, amounts, and categories when making predictions."
            ],
            output: [
                "Provide responses in short, clear sentences.",
                "Include numerical summaries when relevant (e.g., total expenses: $1200).",
                "Avoid speculative answers without supporting data.",
                "If question cannot be answered from data, politely indicate missing information."
            ]
        );
    }
}
