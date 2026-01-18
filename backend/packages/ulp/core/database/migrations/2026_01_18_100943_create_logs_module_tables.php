<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Illuminate\Database\Migrations\Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('logs', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('action');
      $table->string('module_name')->index();
      $table->string('table_name')->index();
      $table->unsignedBigInteger('record_id')->nullable()->index();
      $table->ipAddress('ip_address')->nullable();
      $table->string('route')->nullable();
      $table->json('before')->nullable();
      $table->json('after')->nullable();
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('logs');
  }

};