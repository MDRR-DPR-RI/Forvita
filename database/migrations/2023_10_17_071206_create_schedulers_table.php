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
//      Dummy data for scheduler query test
        Schema::create('dummy_data', function (Blueprint $table) {
            $table->id();
            $table->integer('a');
            $table->integer('b');
            $table->integer('c');
            $table->nullableTimestamps();
        });
        Schema::create('schedulers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('query', 4096);
            $table->string('status');
            $table->foreignId('database_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dummy_data');
        Schema::dropIfExists('schedulers');
    }
};
