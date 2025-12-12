<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id', 'nama')->toArray();

        if (empty($categories)) {
            $this->command->info('Kategori belum ada. Jalankan CategorySeeder dulu.');
            return;
        }

        $products = [
            [
                'nama' => "Laptop Lenovo",
                'description' => "Laptop gaming berkualitas tinggi",
                'price' => 15000000,
                'category' => 'Elektronik'
            ],
            [
                'nama' => "Kaos Polos",
                'description' => "Kaos polos nyaman untuk sehari-hari",
                'price' => 50000,
                'category' => 'Pakaian'
            ],
            [
                'nama' => "Nasi Goreng",
                'description' => "Nasi goreng spesial dengan bumbu rahasia",
                'price' => 20000,
                'category' => 'Makanan'
            ],
            [
                'nama' => "Teh Botol",
                'description' => "Minuman teh manis segar dalam botol",
                'price' => 5000,
                'category' => 'Minuman'
            ],
            [
                'nama' => "Novel Fiksi",
                'description' => "Novel fiksi menarik untuk mengisi waktu luang",
                'price' => 75000,
                'category' => 'Buku'
            ],
        ];

        foreach ($products as $product) {

            // pastikan category ada
            if (!isset($categories[$product['category']])) {
                $this->command->error("Kategori '{$product['category']}' tidak ditemukan!");
                continue;
            }

            Product::create([
                'nama'        => $product['nama'],
                'description' => $product['description'],
                'price'       => $product['price'],
                'category_id' => $categories[$product['category']],
            ]);
        }
    }

}