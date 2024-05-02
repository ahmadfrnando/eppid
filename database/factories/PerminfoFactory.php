<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perminfo>
 */
class PerminfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        $berkasPath = 'berkas/' . Str::random(10) . '.pdf';
        $signaturePath = 'signature-permohonan-informasi/' . Str::random(10) . '.png';

        // Simpan file dummy
        Storage::put($berkasPath, 'Dummy File Content');
        Storage::put($signaturePath, 'Dummy Signature Content');

        $startDate = Carbon::createFromFormat('Y-m-d', '2018-01-01');
        $endDate = Carbon::createFromFormat('Y-m-d', '2024-12-31');

        for ($i = 0; $i < 20; $i++) {
            $data = [
                'user_id' => $faker->numberBetween(1, 10),
                'noperminfo' => 'No.' . $faker->unique()->numberBetween(1000000000, 9999999999),
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'pekerjaan' => $faker->jobTitle,
                'informasidimohon' => $faker->sentence,
                'tujuan' => $faker->sentence,
                'data' => $faker->randomElement(['Data Perkara', 'Data Kepegawaian', 'Data Aset/keuangan', 'Data Umum/lainnya']),
                'jenis' => $faker->randomElement(['Softcopy', 'Hardcopy']),
                'caramemperoleh' => $faker->randomElement(['Melihat', 'Membaca', 'Mendengarkan']),
                'caramendapatkan' => $faker->randomElement(['Mengambil Langsung', 'Mengirim Via Email']),
                'jenisberkas' => $faker->randomElement(['KTP atau SKP', 'Akta Badan Hukum', 'Surat Kuasa dan KTP', 'KITAS dan Paspor', 'Akta Badan Hukum PMA']),
                'berkas' => $berkasPath,
                'buktipengajuan' => $berkasPath,
                'pesan' => 'Silahkan menunggu informasi 14 hari setelah permohonan diterima',
                'status' => $faker->randomElement(['PROSES', 'DITERIMA', 'DITOLAK']),
                'signature' => $signaturePath,
                'created_at' => Carbon::instance($this->getRandomDate($startDate, $endDate)),
                'updated_at' => Carbon::instance($this->getRandomDate($startDate, $endDate)),
            ];
        }

        return $data;
    }

    private function getRandomDate($startDate, $endDate)
    {
        $randomTimestamp = mt_rand($startDate->timestamp, $endDate->timestamp);
        return Carbon::createFromTimestamp($randomTimestamp);
    }
}