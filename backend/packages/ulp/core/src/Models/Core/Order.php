<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core;

class Order extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'price', 'products', 'parcel_number', 'status', 'notes',
  ];

  public function products() {
    return $this->belongsToMany(Product::class)
      ->withPivot(['name', 'unit_price',])
      ->withTimestamps();
  }

  public static function validationRules($id = null): array {
    return [
      //
    ];
  }

}