<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Illuminate\Database\Migrations\Migration {

	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('phone')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->integer('type')->default(0);
			$table->boolean('is_active')->default(false);
			$table->timestamp('email_verified_at')->nullable();
			$table->string('street')->nullable();
			$table->string('city')->nullable();
			$table->string('postcode', 6)->nullable();
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('person_details', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->string('first_name');
			$table->string('sur_name');
			$table->string('pesel', 11)->nullable()->unique();
		});

		Schema::create('company_details', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->string('company_name');
			$table->string('nip', 10);
			$table->string('regon', 14)->nullable();
			$table->string('krs', 10)->nullable();
		});

		Schema::create('password_reset_tokens', function (Blueprint $table) {
			$table->string('email')->primary();
			$table->string('token');
			$table->timestamp('created_at')->nullable();
		});

		Schema::create('sessions', function (Blueprint $table) {
			$table->string('id')->primary();
			$table->foreignId('user_id')->nullable()->index();
			$table->string('ip_address', 45)->nullable();
			$table->text('user_agent')->nullable();
			$table->longText('payload');
			$table->integer('last_activity')->index();
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('users');
		Schema::dropIfExists('password_reset_tokens');
		Schema::dropIfExists('sessions');
	}

};
