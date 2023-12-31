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
      $table->integer('position')->default(0);
      $table->foreignId('chart_id');
      $table->foreignId('dashboard_id');
      $table->foreignId('prompt_id')->default(1);
      $table->string('judul')->default('[""]');
      $table->string('card_title')->nullable();
      $table->string('card_description', 10000)->nullable();
      $table->string('domain_tableau')->nullable();
      $table->string('username_tableau')->nullable();
      $table->string('card_grid')->nullable();
      $table->json('x_value')->default('[[""]]');
      $table->json('y_value')->default('[[""]]');
      $table->json('color')->default('[""]');
      $table->json('clean_created_at')->default('[""]');
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
