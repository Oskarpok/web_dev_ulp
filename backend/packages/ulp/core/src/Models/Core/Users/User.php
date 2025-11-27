<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

use Ulp\Core\Enums\UsersType;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends \Illuminate\Foundation\Auth\User {

  /** @use HasFactory<\Database\Factories\UserFactory> */
  use \Illuminate\Database\Eloquent\Factories\HasFactory, 
    \Illuminate\Notifications\Notifiable, 
    \Ulp\Core\Traits\DefaultModel;

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

  public static function validationRules($id = null): array {
    return [
      'first_name' => ['required', 'string', 'max:255'],
      'is_active' => ['required', 'boolean'],
      'sur_name' => ['required', 'string', 'max:255'],
      'phone' => ['string', 'required'],
      'email' => ['required', 'string', 'email', 'max:255',
        \Illuminate\Validation\Rule::unique('users', 'email')->ignore($id),
      ],
      'type' => ['required', 'integer'],
    ];
  }

  public function getTypeLabelAttribute(): string {
    return UsersType::tryFrom($this->type)?->name ?? UsersType::Undefined->name;
  }

  public function getIsActiveLabelAttribute(): string {
    return $this->getAttribute('is_active') ? 'Yes' : 'No';
  }

}