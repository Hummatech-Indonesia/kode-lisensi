<?php

namespace Database\Seeders;

use App\Models\TermPrivacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermPrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermPrivacy::query()->create([
            'term' => '<h3 style="text-align:center">Kebijakan Penggunaan</h3>

            <h4>1. Pengantar</h4>
            
            <p>Selamat datang di KodeLisensi! Dengan mengakses dan menggunakan situs web kami, Anda setuju untuk mematuhi Kebijakan Penggunaan ini. Jika Anda tidak setuju dengan bagian mana pun dari kebijakan ini, mohon untuk tidak menggunakan situs web kami.</p>
            
            <h4>2. Definisi</h4>
            
            <ul>
                <li><strong>&quot;Pengguna&quot;</strong> merujuk pada setiap individu atau entitas yang mengakses atau menggunakan situs web kami.</li>
                <li><strong>&quot;Kami&quot; atau &quot;KodeLisensi&quot;</strong> merujuk pada pemilik situs web ini.</li>
                <li><strong>&quot;Layanan&quot;</strong> merujuk pada semua layanan yang disediakan oleh KodeLisensi, termasuk penjualan lisensi perangkat lunak.</li>
            </ul>
            
            <h4>3. Perubahan Kebijakan</h4>
            
            <p>Kami berhak untuk mengubah Kebijakan Penggunaan ini kapan saja. Perubahan akan diberitahukan melalui situs web kami. Penggunaan berkelanjutan Anda atas situs web setelah perubahan tersebut dianggap sebagai persetujuan Anda terhadap perubahan tersebut.</p>
            
            <h4>4. Penggunaan Situs Web</h4>
            
            <ul>
                <li>Anda setuju untuk menggunakan situs web ini hanya untuk tujuan yang sah dan sesuai dengan semua hukum dan peraturan yang berlaku.</li>
                <li>Anda tidak diperkenankan untuk menggunakan situs web ini dengan cara yang dapat merusak, menonaktifkan, membebani, atau merusak server kami atau jaringan yang terhubung ke server kami.</li>
            </ul>
            
            <h4>5. Akun Pengguna</h4>
            
            <ul>
                <li>Untuk mengakses beberapa fitur situs web, Anda mungkin diminta untuk membuat akun pengguna.</li>
                <li>Anda bertanggung jawab untuk menjaga kerahasiaan informasi akun Anda, termasuk kata sandi, dan untuk semua aktivitas yang terjadi di bawah akun Anda.</li>
                <li>Anda setuju untuk segera memberitahu kami tentang setiap penggunaan yang tidak sah dari akun Anda atau pelanggaran keamanan lainnya.</li>
            </ul>
            
            <h4>6. Hak Kekayaan Intelektual</h4>
            
            <ul>
                <li>Seluruh konten yang ada di situs web ini, termasuk teks, grafis, logo, dan gambar, adalah milik KodeLisensi atau pemberi lisensi kami dan dilindungi oleh undang-undang hak cipta.</li>
                <li>Anda tidak diperkenankan untuk menyalin, mendistribusikan, atau membuat karya turunan dari konten tersebut tanpa izin tertulis dari kami.</li>
            </ul>
            
            <h4>7. Penafian</h4>
            
            <ul>
                <li>Layanan kami disediakan &quot;sebagaimana adanya&quot; tanpa jaminan apapun, baik tersurat maupun tersirat.</li>
                <li>Kami tidak menjamin bahwa situs web kami akan selalu tersedia, bebas dari kesalahan, atau bebas dari komponen berbahaya.</li>
            </ul>
            
            <h4>8. Hubungi Kami</h4>
            
            <p>Jika Anda memiliki pertanyaan atau kekhawatiran tentang Kebijakan Penggunaan ini, silakan hubungi kami di [<a href="mailto:kodelisensi@gmail.com" target="_blank">kodelisensi@gmail.com</a> atau <a href="https://wa.me/+6282131536153" target="_blank">+62 821-3153-6153</a>].</p>',
            'privacy' => '<h3 style="text-align:center">Syarat &amp; Ketentuan</h3>

            <h4>1. Pengantar</h4>
            
            <p>Selamat datang di KodeLisensi! Dengan mengakses dan menggunakan situs web kami, Anda setuju untuk mematuhi dan terikat oleh Syarat &amp; Ketentuan ini. Jika Anda tidak setuju dengan bagian mana pun dari syarat ini, mohon untuk tidak menggunakan situs web kami.</p>
            
            <h4>2. Pembelian dan Pembayaran</h4>
            
            <ul>
                <li>Semua pembelian lisensi melalui KodeLisensi adalah final dan tidak dapat dikembalikan, kecuali dinyatakan lain dalam kebijakan pengembalian kami.</li>
                <li>Anda setuju untuk menyediakan informasi pembayaran yang akurat dan lengkap saat melakukan pembelian.</li>
            </ul>
            
            <h4>3. Batasan Tanggung Jawab</h4>
            
            <ul>
                <li>KodeLisensi tidak bertanggung jawab atas kerugian atau kerusakan yang timbul dari penggunaan atau ketidakmampuan untuk menggunakan layanan kami.</li>
                <li>Dalam keadaan apapun, tanggung jawab kami kepada Anda untuk semua kerugian, kerusakan, atau klaim tidak akan melebihi jumlah yang Anda bayarkan kepada kami untuk layanan yang bersangkutan.</li>
            </ul>
            
            <h4>4. Hukum yang Berlaku</h4>
            
            <ul>
                <li>Syarat &amp; Ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum yang berlaku di Indonesia.</li>
                <li>Segala perselisihan yang timbul dari atau terkait dengan syarat ini akan diselesaikan di pengadilan yang memiliki yurisdiksi di Indonesia.</li>
            </ul>
            
            <h4>5. Perubahan Syarat</h4>
            
            <p>Kami berhak untuk mengubah Syarat &amp; Ketentuan ini kapan saja. Perubahan akan diberitahukan melalui situs web kami. Penggunaan berkelanjutan Anda atas situs web setelah perubahan tersebut dianggap sebagai persetujuan Anda terhadap perubahan tersebut.</p>
            
            <h4>6. Hubungi Kami</h4>
            
            <p>Jika Anda memiliki pertanyaan atau kekhawatiran tentang Syarat &amp; Ketentuan ini, silakan hubungi kami di <a href="mailto:kodelisensi@gmail.com" target="_blank">kodelisensi@gmail.com</a> atau <a href="https://wa.me/+6282131536153" target="_blank">+62 821-3153-6153</a>.</p>'
        ]);
    }
}
