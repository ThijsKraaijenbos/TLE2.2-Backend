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
        Schema::create('fruits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price')->default(0);
            $table->string('big_img_file_path')->nullable();
            $table->string('small_img_file_path')->nullable();
            $table->integer('weight');
            $table->string('serving_size')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('fruits');
    }
};
