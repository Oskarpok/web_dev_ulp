<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core;

class Order extends \Ulp\Core\Models\Base {

  protected $fillable = [
    'user_id', 'price', 'status', 'parcel_number', 'notes',
  ];

  public function products() {
    return $this->belongsToMany(Product::class)
      ->withPivot([
        'name', 'unit_price', 'is_active', 'specification', 'description',
      ])->withTimestamps();
  }

  // protected static function booted() {
  //   static::updating(function ($order) {
  //     if ($order->isDirty('user_id')) {
  //       throw new \Exception('Pole user_id nie może być modyfikowane po utworzeniu zamówienia.');
  //     }
  //   });
  // }

  public static function validationRules($id = null): array {
    return [
      'user_id' => ['',],
      'price' => ['',],
      'parcel_number' => ['',],
      'status' => ['',],
      'notes' => ['',],
    ];
  }

}