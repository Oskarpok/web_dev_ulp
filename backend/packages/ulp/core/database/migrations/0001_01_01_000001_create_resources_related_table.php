<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Illuminate\Database\Migrations\Migration {
  /**
   * Run the migrations.
   */
    public function up(): void {
      Schema::create('resource_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('parent_id')->nullable();
        $table->foreign('parent_id')->references('id')
          ->on('resource_categories')->onDelete('set null');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        $table->unique(['name', 'parent_id']);
      });

      Schema::create('resource_extensions', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('group')->nullable();
        $table->unsignedBigInteger('max_size')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
      });

      Schema::create('resources', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('path');
        $table->string('alt')->nullable();
        $table->unsignedBigInteger('category_id');
        $table->foreign('category_id')->references('id')
          ->on('resource_categories')->onDelete('cascade');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        $table->unique(['name', 'category_id']);
      });
    }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('resources');
    Schema::dropIfExists('resource_extensions');
    Schema::dropIfExists('resource_categories');
  }

};