<?php

declare(strict_types=1);

namespace Ulp\Crm\Providers;

class CrmServiceProvider extends \Ulp\Core\Providers\BaseServiceProvider {
	
	public function __construct($app) {
		parent::__construct($app, 'crm');
	}

}