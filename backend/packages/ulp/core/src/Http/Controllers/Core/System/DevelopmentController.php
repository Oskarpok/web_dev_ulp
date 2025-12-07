<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\System;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Artisan',
  group: 'Systemic',
  route: 'core.artisan',
)]

class DevelopmentController {

  public static function cleanCache() {
    return redirect()->back()->with('success', 'Cache został wyczyszczony');
  }

}