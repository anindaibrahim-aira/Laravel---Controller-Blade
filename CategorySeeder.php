<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Elektronik', 'Pakaian', 'Makanan', 'Minuman', 'Buku'];

        foreach ($categories as $category) {
            category::create([
                'nama' => $category,
            ]);
        }
    }
}
