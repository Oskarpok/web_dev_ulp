<?php

namespace Ulp\Core\Database\Seeders;

use Ulp\Core\Enums\UsersType;
use Ulp\Core\Models\Core\Users\User;

class UsersSeeder extends \Illuminate\Database\Seeder {
  /**
   * Seed the application's database for users table.
   */
  public function run(): void {
    User::create([
      'first_name' => 'admin',
      'sur_name' => 'admin_admin',
      'phone' => '48234567891',
      'type' => UsersType::Administrator->value,
      'email' => 'admin@example.com',
      'password' => 'admin!1234',
      'is_active' => true,
    ]);
    User::create([
      'first_name' => 'owner',
      'sur_name' => 'owner_owner',
      'phone' => '48345678912',
      'type' => UsersType::Owner->value,
      'email' => 'owner@example.com',
      'password' => 'owner!1234',
      'is_active' => true,
    ]);
    User::create([
      'first_name' => 'manager',
      'sur_name' => 'manager_manager',
      'phone' => '48456789123',
      'type' => UsersType::Manager->value,
      'email' => 'manager@example.com',
      'password' => 'manager!1234',
      'is_active' => true,
    ]);
    User::create([
      'first_name' => 'cms_user',
      'sur_name' => 'cms_user_cms_user',
      'phone' => '48567891234',
      'type' => UsersType::SystemUser->value,
      'email' => 'cmsuser@example.com',
      'password' => 'cmsuser!1234',
      'is_active' => true,
    ]);
    User::create([
      'first_name' => 'user',
      'sur_name' => 'user_user',
      'phone' => '48678912345',
      'type' => UsersType::User->value,
      'email' => 'user@example.com',
      'password' => 'user!1234',
      'is_active' => true,
    ]);
  }
}