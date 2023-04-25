<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        About::query()
            ->create([
                'title' => 'Selamat Datang di KODE Lisensi',
                'content' => 'KODE lisensi merupakan sebuah toko online yang menjual lisensi software premium original serta menyediakan jasa pembayaran transaksi internasional. KODE lisensi hadir sebagai solusi bagi masyarakat yang ingin hijrah / beralih ke software original dengan harga yang cenderung murah.'
            ]);
    }
}
