<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('period_start');
            $table->date('period_end');
            $table->text('notes')->nullable();
            $table->timestamps();
        });


        Schema::create('financial_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId("financial_document_id")
                ->constrained('financial_documents')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['income', 'expense']);
            $table->string('currency', 3)->default('EUR');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial-document');
        Schema::dropIfExists('financial_entries');
    }
};
