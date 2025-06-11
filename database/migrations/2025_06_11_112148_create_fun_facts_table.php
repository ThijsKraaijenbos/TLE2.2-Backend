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
        Schema::create('fun_facts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fruit_id')->constrained(table:'fruits',column: 'id')->cascadeOnDelete();
            $table->string('fruit_fact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fun_facts');
    }
};
