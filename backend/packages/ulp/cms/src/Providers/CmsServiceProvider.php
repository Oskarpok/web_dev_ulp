<?php

declare(strict_types=1);

namespace Ulp\Cms\Providers;

class CmsServiceProvider extends \Ulp\Core\Providers\BaseServiceProvider {
	
	public function __construct($app) {
		parent::__construct($app, 'cms');
	}

}