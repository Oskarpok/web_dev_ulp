<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Cms;

use Ulp\Core\Enums\UsersType;
use Ulp\Core\Traits\DefaultModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends \Illuminate\Foundation\Auth\User {

  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable, DefaultModel;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'first_name',
    'is_active',
    'sur_name',
    'phone',
    'email',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  public static function validationRules(): array {
    return [
      //
    ];
  }

  public function getTypeLabelAttribute(): string {
    return UsersType::tryFrom($this->type)?->name ?? UsersType::Undefined->name;
  }

  public function getIsActiveLabelAttribute(): string {
    return $this->getAttribute('is_active') ? 'Yes' : 'No';
  }

}