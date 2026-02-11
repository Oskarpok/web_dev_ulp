<?php

namespace Ulp\Core\Database\Seeders;

use Ulp\Core\Models\Core\Users\Role;

class RolesSeeder extends \Illuminate\Database\Seeder {

  public function run(): void {
    Role::create([
      'name' => 'Administrator',
      'guard_name' => 'web',
    ]);
    Role::create([
      'name' => 'User',
      'guard_name' => 'api_web',
    ]);
  }

}