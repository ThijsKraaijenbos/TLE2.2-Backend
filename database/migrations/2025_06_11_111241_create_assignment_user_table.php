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
        Schema::create('assignment_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table:'users',column: 'id');
            $table->foreignId('assignment_id')->constrained(table:'assignment',column: 'id');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_user');
    }
};
