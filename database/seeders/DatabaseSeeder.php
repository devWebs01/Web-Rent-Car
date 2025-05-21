<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dating;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Database\Seeders\RentalSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            RentalSeeder::class,
        ]);

        Transaction::factory()
            ->count(10)
            ->create()
            ->each(function ($transaction) {
                // Untuk setiap transaksi, buat data dating terkait
                Dating::factory()
                    ->count(1)
                    ->create(['transaction_id' => $transaction->id]);
            });


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin'
        ]);
    }
}
