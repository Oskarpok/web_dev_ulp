<?php

declare(strict_types=1);

namespace Ulp\Core\Providers;

use Illuminate\Support\Facades\View;

class CoreServiceProvider extends \Ulp\Core\Providers\BaseServiceProvider {

	public function __construct($app) {
		parent::__construct($app, 'core');
	}

  public function register(): void {
    parent::boot();
    $this->mergeConfigFrom($this->packagePath . 'config/permission.php', 'permission');
  }

	public function boot(): void {
		parent::boot();
		View::share('HelperFrontEndBase', \Ulp\Core\Helpers\Frontend\Base::class);
	}

}