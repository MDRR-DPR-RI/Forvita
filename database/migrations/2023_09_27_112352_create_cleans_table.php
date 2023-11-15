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
        Schema::create('cleans', function (Blueprint $table) {
            $table->id();
            $table->string('grup')->nullable();
            $table->string('data')->nullable();
            $table->string('judul');
            $table->string('keterangan');
            $table->string('jumlah');
            $table->boolean('newest')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleans');
    }
};
