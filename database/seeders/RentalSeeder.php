<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;


class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::create([
            'name' => 'Humayra Rental',
            'thumbnail' => 'https://lh3.googleusercontent.com/p/AF1QipMqgS3XCLm6dK-54OriCkj6rlS6C4gaEbk04JM2=w408-h408-k-no',
            'url_maps' => 'https://maps.app.goo.gl/JZnC8uuW3oZVtTm2A',
            'phone_number' => '082379995788',
            'address' => 'Jl. H. Muchtar, Kenali Besar, Kec. Kota Baru, Kota Jambi, Jambi 36361',
            'latitude' => -1.6114534704594516,
            'longitude' => 103.56131886673174,
        ]);
    }
}
