<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Slider::query()
            ->create([
                'offer' => 'Diskon Awal Semua Produk sebesar 50%',
                'header' => 'Software Lisensi Legal',
                'sub_header' => 'untuk semua produk diskon dibawah 50%',
                'description' => 'semua tersedia hinggal tanggal 12 Mei',
                'image' => 'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
                'product_url' => 'https://127.0.0.1:8000/products'
            ]);
    }
}
