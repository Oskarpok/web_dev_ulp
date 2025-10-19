<?php

declare(strict_types=1);

namespace Ulp\Crm\Providers;

use Illuminate\Support\ServiceProvider;

class CrmServiceProvider extends ServiceProvider {
	
  public const CRM_ROOT_PATH = __DIR__ . '/../../';

	/**
	 * Register any application services.
	 */
	public function register(): void {
		// $crmConfig = require self::CRM_ROOT_PATH . 'config/';
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
    $this->loadRoutesFrom(self::CRM_ROOT_PATH . 'routes/web.php');
    $this->loadMigrationsFrom(self::CRM_ROOT_PATH . 'database/migrations');
    $this->loadViewsFrom(self::CRM_ROOT_PATH .'resources/views', 'crm');
	}

}