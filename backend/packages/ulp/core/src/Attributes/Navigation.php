<?php

declare(strict_types=1);

namespace Ulp\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Navigation{
  public function __construct (
    public string $title,
    public string $group,
    public string $route,
    public array $acces
  ) 
  {

  }
}