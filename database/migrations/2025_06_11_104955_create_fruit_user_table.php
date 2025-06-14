<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fruit_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fruit_id')->constrained(table: 'fruits', column: 'id')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained(table: 'users', column: 'id')->cascadeOnDelete();
            $table->boolean('has_eaten_before')->default(value: false);
            $table->boolean( 'like')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_user');
    }
};
