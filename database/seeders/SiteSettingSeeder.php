<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::query()
            ->create([
                'name' => config('app.name'),
                'description' => 'KODE lisensi merupakan sebuah toko online yang menjual lisensi software premium original serta menyediakan jasa pembayaran transaksi internasional. KODE lisensi hadir sebagai solusi bagi masyarakat yang ingin hijrah / beralih ke software original dengan harga yang cenderung murah.',
                'phone_number' => '+62 821-3153-6153',
                'email' => 'kodelisensi@gmail.com',
                'facebook' => 'https://www.facebook.com/kodelisensi',
                'twitter' => 'https://twitter.com/kodelisensi',
                'youtube' => 'https://www.youtube.com/channel/UCABkK5Miugp0m_nwcbPyMYw',
                'instagram' => 'https://www.instagram.com/kodelisensi'
            ]);
    }
}
