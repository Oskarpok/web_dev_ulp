<?php

declare(strict_types=1);

namespace Ulp\Core\Providers;

class CoreServiceProvider extends \Ulp\Core\Providers\BaseServiceProvider {

	public function __construct($app) {
		parent::__construct($app, 'core');
	}

}