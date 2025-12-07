<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\System;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Artisan',
  group: 'Systemic',
  route: 'core.artisan.panel',
)]

class DevelopmentController extends \Illuminate\Routing\Controller {

  public static function panel() {
    return view('core::templates.development.artisan');
  }

  public static function cleanCache() {
    // to do

    return redirect()->back()->with('success', 'Cache został wyczyszczony');
  }

}