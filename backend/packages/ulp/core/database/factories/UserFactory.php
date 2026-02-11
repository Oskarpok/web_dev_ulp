<?php

namespace Ulp\Core\Database\Factories;

use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends \Illuminate\Database\Eloquent\Factories\Factory {

  protected $model = \Ulp\Core\Models\Core\Users\User::class;

  /**
   * The current password being used by the factory.
   */
  protected static ?string $password;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    return [
      'phone' => $this->faker->unique()->numerify('#########'),
      'email' => $this->faker->unique()->safeEmail(),
      'password' => static::$password ??= Hash::make('password'),
      'is_active' => true,
      'email_verified_at' => now(),
      'remember_token' => \Illuminate\Support\Str::random(10),
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static {
    return $this->state(fn (array $attributes) => [
      'email_verified_at' => null,
    ]);
  }

}
