<?php

declare(strict_types=1);

namespace Ulp\Core\Helpers\Frontend;

use ReflectionClass;
use Illuminate\Support\Facades\File;

class Base {

  /**
   * Build navigation array based on controller metadata.
   *
   * This method scans all controllers under the Core namespace, looks for
   * the Navigation attribute, and generates an array of menu items for the
   * currently authenticated user.
   * Only controllers with the Navigation attribute are considered.
   * User access is filtered based on the roles defined in the attribute.
   *
   * @return array Navigation grouped by the attribute's group property.
   */
  public static function buildNavigation(): array {
    $navigation = [];

    foreach (File::allFiles(realpath(__DIR__ . '/../../Http/Controllers/Core')) 
      as $file) {
        $class = 'Ulp\\Core\\Http\\Controllers\\Core\\' . 
          str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());

        if(!class_exists($class)) continue;
        $attributes = (new \ReflectionClass($class))
          ->getAttributes(\Ulp\Core\Attributes\Navigation::class);

        if(empty($attributes)) continue;
        $atr = $attributes[0]->newInstance();
        if(!in_array(auth()->user()->getRawOriginal('type'), $atr->roles)) continue;

        $navigation[$atr->group][] = [
          'title' => $atr->title,
          'route' => $atr->route,
        ];
    }
    return $navigation;
  }

}