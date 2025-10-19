<?php

declare(strict_types=1);

namespace Ulp\Cms\Providers;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider {
	
  public const CMS_ROOT_PATH = __DIR__ . '/../../';

	/**
	 * Register any application services.
	 */
	public function register(): void {
		// $cmsConfig = require self::CMS_ROOT_PATH . 'config/';
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
    $this->loadRoutesFrom(self::CMS_ROOT_PATH . 'routes/web.php');
    $this->loadMigrationsFrom(self::CMS_ROOT_PATH . 'database/migrations');
    $this->loadViewsFrom(self::CMS_ROOT_PATH .'resources/views', 'cms');
	}

}