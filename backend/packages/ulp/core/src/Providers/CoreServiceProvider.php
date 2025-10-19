<?php

declare(strict_types=1);

namespace Ulp\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {
	
  public const Core_ROOT_PATH = __DIR__ . '/../../';

	/**
	 * Register any application services.
	 */
	public function register(): void {
		// $coreConfig = require self::Core_ROOT_PATH . 'config/';
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
    $this->loadRoutesFrom(self::Core_ROOT_PATH . 'routes/web.php');
    $this->loadMigrationsFrom(self::Core_ROOT_PATH . 'database/migrations');
    $this->loadViewsFrom(self::Core_ROOT_PATH .'resources/views', 'core');
	}

}