<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusType;

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
            $table->string('status')->default(StatusType::Generado->value);
            $table->foreignId('house_id')->constrained('houses');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('penalty_category_id')->constrained('penalty_categories');
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
