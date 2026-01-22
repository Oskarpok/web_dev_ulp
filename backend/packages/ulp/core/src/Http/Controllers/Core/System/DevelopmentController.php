<?php

declare(strict_types=1);

namespace Ulp\Core\Http\Controllers\Core\System;

use Ulp\Core\View\FormFields\Buttons\ButtonsTypeController;

#[\Ulp\Core\Attributes\Navigation(
  title: 'Artisan',
  group: 'Systemic',
  route: 'core.artisan.panel',
)]

class DevelopmentController extends \Illuminate\Routing\Controller {

  public static function panel() {
    return view('core::templates.development.artisan',[
      'buttons' => [
        ButtonsTypeController::make([
          'type' => 'anchore',
          'routeName' => 'core.artisan.clean_cache',
          'label' => 'Clean Cache',
          'icone' => 'fa-solid fa-trash',
          'style' => 1,
        ]),
      ]
    ]);
  }

  public static function cleanCache() {
    // to do

    return redirect()->back()->with('success', 'Cache został wyczyszczony');
  }

}