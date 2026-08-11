<?php

namespace Database\Seeders;

use App\Models\GlossaryTerm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * 18 istilah glosarium draft dari 05-placeholder-content-pajak.md bagian 2.
 * Disimpan is_active = false (DRAFT); diaktifkan manual oleh Bapak Yani.
 */
class GlossaryTermSeeder extends Seeder
{
    public function run(): void
    {
        $terms = [
            ['term' => 'NPWP', 'definition' => 'Nomor Pokok Wajib Pajak, identitas resmi yang diberikan kepada Wajib Pajak sebagai sarana administrasi perpajakan.'],
            ['term' => 'SPT', 'definition' => 'Surat Pemberitahuan, dokumen yang digunakan Wajib Pajak untuk melaporkan penghitungan dan/atau pembayaran pajak.'],
            ['term' => 'SPT Masa', 'definition' => 'SPT yang digunakan untuk melaporkan pajak dalam suatu periode tertentu, biasanya bulanan.'],
            ['term' => 'SPT Tahunan', 'definition' => 'SPT yang digunakan untuk melaporkan penghitungan pajak dalam satu tahun pajak.'],
            ['term' => 'PPh', 'definition' => 'Pajak Penghasilan, pajak yang dikenakan atas penghasilan yang diterima atau diperoleh Wajib Pajak.'],
            ['term' => 'PPN', 'definition' => 'Pajak Pertambahan Nilai, pajak yang dikenakan atas konsumsi barang dan jasa kena pajak di dalam negeri.'],
            ['term' => 'PTKP', 'definition' => 'Penghasilan Tidak Kena Pajak, batas penghasilan tertentu yang tidak dikenakan pajak bagi Wajib Pajak Orang Pribadi.'],
            ['term' => 'PKP', 'definition' => 'Pengusaha Kena Pajak, pengusaha yang melakukan penyerahan barang/jasa kena pajak dan wajib memungut PPN.'],
            ['term' => 'Bukti Potong', 'definition' => 'Dokumen yang diterbitkan pemotong/pemungut pajak sebagai bukti telah dilakukan pemotongan/pemungutan pajak.'],
            ['term' => 'Restitusi', 'definition' => 'Pengembalian kelebihan pembayaran pajak kepada Wajib Pajak.'],
            ['term' => 'Keberatan', 'definition' => 'Upaya hukum administratif yang diajukan Wajib Pajak yang tidak setuju atas suatu ketetapan pajak.'],
            ['term' => 'Banding', 'definition' => 'Upaya hukum lanjutan ke Pengadilan Pajak setelah keputusan keberatan tidak diterima oleh Wajib Pajak.'],
            ['term' => 'Gugatan', 'definition' => 'Upaya hukum yang diajukan Wajib Pajak atas pelaksanaan penagihan pajak atau keputusan tertentu ke Pengadilan Pajak.'],
            ['term' => 'Tax Planning', 'definition' => 'Perencanaan pajak yang dilakukan secara legal untuk mengoptimalkan kewajiban perpajakan sesuai ketentuan yang berlaku.'],
            ['term' => 'Kuasa Hukum Pajak', 'definition' => 'Pihak yang diberi kuasa untuk mewakili dan mendampingi Wajib Pajak dalam proses hukum di bidang perpajakan.'],
            ['term' => 'Kuasa Kepabeanan dan Cukai', 'definition' => 'Pihak yang diberi kuasa untuk mengurus kepentingan Wajib Pajak/importir dalam bidang kepabeanan dan cukai.'],
            ['term' => 'Tax Review', 'definition' => 'Proses pemeriksaan kepatuhan pajak secara internal untuk memastikan kesesuaian dengan ketentuan yang berlaku.'],
            ['term' => 'Wajib Pajak', 'definition' => 'Orang pribadi atau badan yang memiliki hak dan kewajiban perpajakan sesuai peraturan perundang-undangan.'],
        ];

        foreach ($terms as $index => $item) {
            GlossaryTerm::updateOrCreate(
                ['slug' => Str::slug($item['term'])],
                [
                    'term' => $item['term'],
                    'definition' => $item['definition'],
                    'order' => $index + 1,
                    'is_active' => false, // DRAFT
                ],
            );
        }
    }
}
