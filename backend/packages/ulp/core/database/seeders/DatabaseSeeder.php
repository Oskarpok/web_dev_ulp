<?php

namespace Ulp\Core\Database\Seeders;

class DatabaseSeeder extends \Illuminate\Database\Seeder {

  public function run(): void {
    $this->call([
      UsersSeeder::class,
      ParamsSeeder::class,
    ]);
  }
}