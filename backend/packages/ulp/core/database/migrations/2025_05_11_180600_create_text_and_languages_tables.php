<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Illuminate\Database\Migrations\Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {

    Schema::create('texts', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->timestamps();
    });

    Schema::create('languages', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('shortcut')->unique();
      $table->boolean('is_active')->default(false);
      $table->timestamps();
    });

    Schema::create('text_translations', function (Blueprint $table) {
      $table->id();
      $table->foreignId('text_id')->constrained()->cascadeOnDelete();
      $table->foreignId('language_id')->constrained()->cascadeOnDelete();
      $table->text('translation');
      $table->timestamps();
      $table->unique(['text_id', 'language_id']);
    });
    
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('texts');
    Schema::dropIfExists('languages');
    Schema::dropIfExists('text_translations');
  }

};