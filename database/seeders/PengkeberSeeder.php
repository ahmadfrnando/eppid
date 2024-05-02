<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PengkeberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $userId = 1;

        // Loop untuk membuat 20 data faker
        for ($i = 0; $i < 20; $i++) {
            $berkasPath = 'berkas/' . Str::random(10) . '.pdf';
            $signaturePath = 'signature-permohonan-informasi/' . Str::random(10) . '.png';

            $user_id = $faker->numberBetween(1, 10);
            $perminfo = DB::table('perminfo')->where('user_id', $user_id)->inRandomOrder()->first();
            $startDate = Carbon::createFromFormat('Y-m-d', '2018-01-01');
            $endDate = Carbon::createFromFormat('Y-m-d', '2024-12-31');
            if ($perminfo) {
                // Simpan file dummy
                Storage::put($berkasPath, 'Dummy File Content');
                Storage::put($signaturePath, 'Dummy Signature Content');
                DB::table('pengkeber')->insert([
                    'user_id' => $user_id,
                    'noperminfo' => $perminfo->noperminfo,
                    'nopengkeber' => 'No.' . $faker->unique()->numberBetween(1000000000, 9999999999),
                    'nama' => $faker->name,
                    'alamat' => $faker->address,
                    'pekerjaan' => $faker->jobTitle,
                    'tujuan' => $faker->sentence,
                    'notel' => $faker->phoneNumber,
                    'data' => $faker->randomElement(['Data Perkara', 'Data Kepegawaian', 'Data Aset/keuangan', 'Data Umum/lainnya']),
                    'alasan' => $faker->randomElement(['Permohonan informasi ditolak', 'Informasi berkala tidak disediakan', 'Permintaan tidak ditanggapin', 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta', 'Permintaan informasi tidak dipenuhi', 'Biaya yang dikenakan tidak wajar', 'Informasi yang disampaikan melebihi jangka waktu yang ditentukan']),
                    'kaspol' => $faker->word,
                    'status' => $faker->randomElement(['PROSES', 'DITERIMA', 'DITOLAK']),
                    'signature' => 'signature-pengkeber/' . $faker->unique()->randomNumber(5) . '.png',
                    'buktipengajuan' => $berkasPath,
                    'pesan' => 'Silahkan menunggu informasi 14 hari setelah permohonan diterima',
                    'created_at' => Carbon::instance($this->getRandomDate($startDate, $endDate)),
                    'updated_at' => Carbon::instance($this->getRandomDate($startDate, $endDate)),
                ]);
            }
        }
    }

    private function getRandomDate($startDate, $endDate)
    {
        $randomTimestamp = mt_rand($startDate->timestamp, $endDate->timestamp);
        return Carbon::createFromTimestamp($randomTimestamp);
    }
}