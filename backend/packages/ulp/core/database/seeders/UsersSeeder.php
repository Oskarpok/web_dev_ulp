<?php

namespace Ulp\Core\Database\Seeders;

use Ulp\Core\Enums\UsersType;
use Illuminate\Support\Facades\Hash;
use Ulp\Core\Models\Core\Users\User;

class UsersSeeder extends \Illuminate\Database\Seeder {
  /**
   * Seed the application's database for users table.
   */
  public function run(): void {
    User::create([
      'phone' => '48234567891',
      'user_type_id' => UsersType::Administrator->value,
      'email' => 'admin@example.com',
      'password' => Hash::make('admin!1234'),
      'is_active' => true,
    ]);
    User::create([
      'phone' => '48678912345',
      'user_type_id' => UsersType::User->value,
      'email' => 'user@example.com',
      'password' => Hash::make('user!1234'),
      'is_active' => true,
    ]);
  }
}