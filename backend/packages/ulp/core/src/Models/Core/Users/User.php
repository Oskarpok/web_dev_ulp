<?php

declare(strict_types=1);

namespace Ulp\Core\Models\Core\Users;

use Ulp\Core\Traits\DefaultModel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends \Illuminate\Foundation\Auth\User {

  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable, DefaultModel, HasRoles;

  // Factores function
  protected static function newFactory() {
    return \Ulp\Core\Database\Factories\UserFactory::new();
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = ['is_active', 'phone', 'email', ];

  /**
   * The attributes that should be hidden or apend for serialization.
   *
   * @var list<string>
   */
  protected $hidden = ['password', 'remember_token', ];
  protected $appends = ['is_active_label', ];

  public static function validationRules($id = null): array {
    return [
      'first_name' => ['required', 'string', 'max:255', ],
      'is_active' => ['required', 'boolean', ],
      'sur_name' => ['required', 'string', 'max:255', ],
      'phone' => ['string', 'required', 'min:9', ],
      'email' => ['required', 'string', 'email', 'max:255', ],
      'type' => ['required', 'integer', ],
    ];
  }

  public function getIsActiveLabelAttribute(): string {
    return $this->getAttribute('is_active') ? 'Yes' : 'No';
  }

  // Relacja do zwykłych detali (Osoba)
  public function userDetails(): HasOne {
    return $this->hasOne(UserDetail::class, 'user_id')->withDefault();
  }

  // Relacja do firmy
  public function companyDetails(): HasOne {
    return $this->hasOne(CompanyDetail::class, 'user_id')->withDefault();
  }

  // Relacja do pracownika systemu
  public function systemUserDetails(): HasOne {
    return $this->hasOne(SystemUserDetail::class, 'user_id')->withDefault();
  }

  // Relacja do parametrów (Wiele parametrów dla jednego użytkownika)
  public function params(): HasMany {
    return $this->hasMany(UserParam::class, 'user_id');
  }

  // Pozwala pobrać detale bez wiedzy, w której są tabeli: $user->profile
  public function getProfileAttribute() {
    $role = $this->roles->first();

    if (!$role || !$role->details_table) {
      return null;
    }

    return match($role->details_table) {
      'user_details' => $this->userDetails,
      'company_details' => $this->companyDetails,
      'system_user_details' => $this->systemUserDetails,
      default => null,
    };
  }

  public function getAttribute($key) {
    $attribute = parent::getAttribute($key);

    // Dodajemy zabezpieczenie, żeby nie szukać w profilu, gdy szukamy samego profilu (pętla)
    // Dorzliw ze dja roles na przyszlao prze z spite
    if (is_null($attribute) && !in_array($key, [
      'userDetails', 'companyDetails', 'systemUserDetails', 'params'
      ])) {
      $profile = $this->profile;
          
      // Jeśli profil istnieje, spróbuj wyciągnąć z niego wartość
      if ($profile) {
        return $profile->getAttribute($key);
      }
    }
    return $attribute;
  }

}