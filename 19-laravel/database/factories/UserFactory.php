<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


   public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        $url = "https://xsgames.co/randomusers/avatar.php?g=" . $gender;
        $document = fake()->numerify('75######');
        $nombreArchivo="{$document}.png";
        $rutaDestino = public_path("images/{$nombreArchivo}");
        copy($url, $rutaDestino);
        return [
            'document' => $document,
            'fullname' => fake()->name($gender),
            'gender' => $gender,
            'birthdate' => fake()->dateTimeBetween('1976-01-01', '2006-12-31'),
            'photo' => $nombreArchivo,
            'phone' => fake()->numerify('320#######'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
