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
        Schema::create('penalties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->float('amount')->nullable();
            $table->integer('status');
            $table->foreignId('house_id')->constrained('houses')->nullable();
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->foreignId('penalty_category_id')->constrained('penalty_categories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
