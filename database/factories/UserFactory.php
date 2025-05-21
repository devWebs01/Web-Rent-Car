<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $imageUrl = 'https://picsum.photos/400/300?' . Str::random(10);
        $imageName = Str::random(20) . '.jpg'; // pastikan ekstensi
        $storagePath = 'profile/' . $imageName;

        try {
            $response = Http::get($imageUrl);

            if ($response->successful()) {
                Storage::disk('public')->put($storagePath, $response->body());
            } else {
                Log::warning("Gagal ambil gambar dari URL: $imageUrl");
                $storagePath = 'default.jpg'; // fallback
            }
        } catch (\Exception $e) {
            Log::error("Error ambil gambar: " . $e->getMessage());
            $storagePath = 'default.jpg';
        }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone_number' => fake()->phoneNumber(),
            'role' => fake()->randomElement(['customer', 'admin']),
            'address' => fake()->address(),
            'identify' => $storagePath,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
