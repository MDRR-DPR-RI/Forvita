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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chart_id');
            $table->foreignId('dashboard_id');
            $table->foreignId('prompt_id')->default(1);
            $table->string('result_prompt')->nullable();
            $table->string('judul')->nullable();
            $table->json('x_value')->nullable();
            $table->json('y_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
