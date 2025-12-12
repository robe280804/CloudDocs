<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FinancialDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        $userId = '019b1233-8681-72f5-b3b5-7a3d245025af';

        $incomeTitles = [
            'Invoice Payment',
            'Salary',
            'Project Bonus',
            'Consulting Fee',
            'Interest Income'
        ];
        $incomeDescriptions = [
            'Payment received for completed project',
            'Monthly salary credited',
            'Bonus awarded for exceptional performance',
            'Consulting fee for client work',
            'Interest earned from savings account'
        ];

        $expenseTitles = [
            'Office Rent',
            'Utilities',
            'Software Subscription',
            'Travel Expenses',
            'Equipment Purchase'
        ];
        $expenseDescriptions = [
            'Monthly office rent payment',
            'Electricity and water bills',
            'Subscription for software tools',
            'Travel expenses for business trip',
            'Purchase of new office equipment'
        ];

        // Crea 10 financial documents
        for ($j = 0; $j < 10; $j++) {
            $documentId = DB::table('financial_document')->insertGetId([
                'user_id' => $userId,
                'period_start' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'period_end' => $faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                'notes' => 'Financial report',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crea 3 financial entries for document
            for ($k = 0; $k < 3; $k++) {
                $type = $faker->randomElement(['income', 'expense']);

                if ($type === 'income') {
                    $title = $faker->randomElement($incomeTitles);
                    $description = $faker->randomElement($incomeDescriptions);
                } else {
                    $title = $faker->randomElement($expenseTitles);
                    $description = $faker->randomElement($expenseDescriptions);
                }

                DB::table('financial_entries')->insert([
                    'financial_document_id' => $documentId,
                    'title' => $title,
                    'description' => $description,
                    'date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                    'amount' => $faker->randomFloat(2, 10, 1000),
                    'type' => $type,
                    'currency' => 'EUR',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
