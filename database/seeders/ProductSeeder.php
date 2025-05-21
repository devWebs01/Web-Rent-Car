<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ImageProduct;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Exception;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to the JSON file
        $path = public_path('datajson/cars.json');

        // Check if the file exists
        if (!File::exists($path)) {
            Log::error("File not found: $path");
            return;
        }

        // Read the JSON file
        $json = File::get($path);

        // Decode JSON data to PHP array
        $data = json_decode($json, true);

        // Check if JSON decoding was successful
        if ($data === null) {
            Log::error("Error decoding JSON file: $path");
            return;
        }

        // Initialize Guzzle client
        $client = new Client();

        // Loop through the data and create entries in the database
        foreach ($data as $item) {
            try {
                // Trim spaces from the URL
                $imageUrl = trim($item['image']);
                $imageName = basename($imageUrl);
                $imagePath = 'public/cars/' . $imageName;

                // Download the image using Guzzle
                $response = $client->get($imageUrl);

                if ($response->getStatusCode() !== 200) {
                    throw new Exception("Failed to download image from $imageUrl");
                }

                $imageData = $response->getBody()->getContents();

                // Save the image to storage
                Storage::put($imagePath, $imageData);

                // Create product entry
                $product = product::create([
                    'category_id' => $item['category_id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'capacity' => $item['capacity'],
                    'space' => $item['space'],
                    'description' => $item['description'],
                ]);

                // Create product image entry
                imageProduct::create([
                    'product_id' => $product->id,
                    'image_path' => 'cars/' . $imageName, // Path without 'public/'
                ]);

                $this->command->info('Tambah Mobil ' . $product->name);
            } catch (Exception $e) {
                Log::error("Error processing item: " . $e->getMessage());
            }
        }
    }
}
