<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_year_id')->constrained('budget_years')->cascadeOnDelete();
            $table->string('type', 30); // Pendapatan, Belanja, Pembiayaan
            $table->string('category');
            $table->string('description');
            $table->unsignedBigInteger('budget_amount')->default(0);
            $table->unsignedBigInteger('realized_amount')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_items');
    }
};
