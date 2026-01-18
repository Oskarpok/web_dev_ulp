<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\System;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Migration',
  group: 'Systemic',
  route: 'core.showMigrations',
)]

class MigrationController extends \Illuminate\Routing\Controller {

  public function showMigrations() {
    $executed = \DB::table('migrations')->pluck('migration')->toArray();
    $migrations = [];

    foreach (config('packages.paths') as $package => $path) {
      foreach (glob($path . '/database/migrations/*.php') as $file) {
        $name = basename($file, '.php');
        $migrations[] = [
          'package' => $package,
          'name'    => $name,
          'batch' => in_array($name, $executed)
        ];
      }
    }

    usort($migrations, fn ($a, $b) => strcmp($b['name'], $a['name']));
    return view('core::templates.development.migrations', [
      'migrations' => $migrations,
      'button' => \Ulp\Core\View\FormFields\Buttons\ButtonsTypeController::make([
        'type'  => 'anchore',
        'route' => route('core.doMigrations'),
        'label' => 'Migrate',
        'icone' => 'fa-solid fa-rotate',
      ]),
    ]);
  }

  public function doMigrations() {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return redirect()->route('core.showMigrations')->with('status', 
      'Migracje zostały wykonane.');
  }

}