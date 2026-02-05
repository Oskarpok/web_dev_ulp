<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Illuminate\Database\Migrations\Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {

    Schema::create('params', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->integer('type')->default(0); 
      $table->string('val_string')->nullable();
      $table->integer('val_int')->nullable();
      $table->float('val_float')->nullable();
      $table->boolean('val_bool')->nullable();
      $table->json('val_json')->nullable();
      $table->timestamps();
    });
    
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('params');
  }

};