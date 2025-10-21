<?php

declare(strict_types=1);

namespace Ulp\Core\Enums;

enum UsersType: int {
  
  case Undefined = 0;
  case Administrator = 1;
  case Owner = 2;
  case Manager = 3;
  case CmsUser = 4;
  case User = 5;

  public static function toArray(): array {
    return collect(self::cases())
      ->mapWithKeys(fn($case) => [$case->value => $case->name])->toArray();
  }
}