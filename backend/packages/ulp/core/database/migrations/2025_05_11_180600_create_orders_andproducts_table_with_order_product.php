<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Illuminate\Database\Migrations\Migration {

  /**
   * Run the migrations.
   */
  public function up(): void {

    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->decimal('price', 10, 2);
      $table->string('parcel_number')->unique()->nullable();
      $table->string('status');
      $table->json('notes')->nullable();
      $table->timestamps();
    });

    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->decimal('unit_price', 10, 2);
      $table->boolean('is_active')->default(false);
      $table->json('specification')->nullable();
      $table->text('description')->nullable();
      $table->timestamps();
    });

    Schema::create('order_product', function (Blueprint $table) {
      $table->id();
      $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
      $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
      $table->integer('quantity');
      $table->decimal('price_purchase', 10, 2);
      $table->timestamps();
      $table->unique(['order_id', 'product_id']);
      $table->index(['order_id', 'product_id']);
    });
    
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('orders');
    Schema::dropIfExists('products');
    Schema::dropIfExists('order_product');
  }

};