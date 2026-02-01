<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

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
    'first_name', 'is_active', 'sur_name', 'phone', 'email', 'type',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = ['password', 'remember_token',];

  protected $appends = ['is_active_label', 'type_label'];

  public static function validationRules($id = null): array {
    return [
      'first_name' => ['required', 'string', 'max:255',],
      'is_active' => ['required', 'boolean',],
      'sur_name' => ['required', 'string', 'max:255',],
      'phone' => ['string', 'required', 'min:9',],
      'email' => ['required', 'string', 'email', 'max:255',],
      'type' => ['required', 'integer',],
    ];
  }

  public function getTypeLabelAttribute(): string {
    return UsersType::tryFrom($this->type)?->name ?? UsersType::Undefined->name;
  }

  public function getIsActiveLabelAttribute(): string {
    return $this->getAttribute('is_active') ? 'Yes' : 'No';
  }

}