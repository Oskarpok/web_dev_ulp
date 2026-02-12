<?php

namespace Ulp\Core\Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Ulp\Core\Models\Core\Users\User;
use Ulp\Core\Models\Core\Users\Role;

class UsersSeeder extends \Illuminate\Database\Seeder {

  /**
   * Seed the application's database for users table.
   */
  public function run(): void {

    $userRole = Role::firstOrCreate([
      'name' => 'User', 
      'guard_name' => 'web', 
      'details_table' => 'user_details'
    ]);
    $companyRole = Role::firstOrCreate([
      'name' => 'Company', 
      'guard_name' => 'web', 
      'details_table' => 'company_details'
    ]);
    $systemRole = Role::firstOrCreate([
      'name' => 'Administrator', 
      'guard_name' => 'web', 
      'details_table' => 'system_user_details'
    ]);

    User::create([
      'phone' => '48234567891',
      'email' => 'admin@example.com',
      'password' => Hash::make('admin!123'),
      'is_active' => true,
    ]);

    /*
    |--------------------------------------------------------------------------
    | 20 ordinary users
    |--------------------------------------------------------------------------
    */
    User::factory(20)->create()->each(function ($user) use ($userRole) {
      $user->assignRole($userRole);

      \Ulp\Core\Models\Core\Users\UserDetail::create([
        'user_id' => $user->id,
        'first_name' => fake()->firstName(),
        'sur_name' => fake()->lastName(),
        'pesel' => fake()->unique()->numerify('###########'),
        'street' => fake()->streetAddress(),
        'city' => fake()->city(),
        'postcode' => fake()->numerify('##-###'),
      ]);
    });

    /*
    |--------------------------------------------------------------------------
    | 10 biznes
    |--------------------------------------------------------------------------
    */
    User::factory(10)->create()->each(function ($user) use ($companyRole) {
      $user->assignRole($companyRole);

      \Ulp\Core\Models\Core\Users\CompanyDetail::create([
        'user_id' => $user->id,
        'company_name' => fake()->company(),
        'street' => fake()->streetAddress(),
        'city' => fake()->city(),
        'postcode' => fake()->postcode(),
        'nip' => fake()->unique()->numerify('##########'),
        'regon' => fake()->numerify('##############'),
        'krs' => fake()->numerify('##########'),
      ]);
    });

    /*
    |--------------------------------------------------------------------------
    | 5  system users
    |--------------------------------------------------------------------------
    */
    User::factory(5)->create()->each(function ($user) use ($systemRole) {
      $user->assignRole($systemRole);

      \Ulp\Core\Models\Core\Users\SystemUserDetail::create([
        'user_id' => $user->id,
        'first_name' => fake()->firstName(),
        'sur_name' => fake()->lastName(),
        'pesel' => fake()->unique()->numerify('###########'),
      ]);
    });
  }

}