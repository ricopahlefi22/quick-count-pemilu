<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use App\Models\VotingPlace;
use Illuminate\Database\Seeder;

class Dapil6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::factory()->create(['name' => 'Kendawangan']);
        // DESA AIR HITAM BESAR
        Village::factory()->create(['name' => 'Desa Air Hitam Besar', 'district_id' => 1]);
        for ($i = 1; $i <= 11; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 1,
                'district_id' => 1,
            ]);
        }
        // DESA AIR HITAM HULU
        Village::factory()->create(['name' => 'Desa Air Hitam Hulu', 'district_id' => 1]);
        for ($i = 1; $i <= 7; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 2,
                'district_id' => 1,
            ]);
        }
        // DESA AIR TARAP
        Village::factory()->create(['name' => 'Desa Air Tarap', 'district_id' => 1]);
        for ($i = 1; $i <= 3; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 3,
                'district_id' => 1,
            ]);
        }
        // DESA BANGKAL SERAI
        Village::factory()->create(['name' => 'Desa Bangkal Serai', 'district_id' => 1]);
        for ($i = 1; $i <= 5; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 4,
                'district_id' => 1,
            ]);
        }
        // DESA BANJAR SARI
        Village::factory()->create(['name' => 'Desa Banjar Sari', 'district_id' => 1]);
        for ($i = 1; $i <= 14; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 5,
                'district_id' => 1,
            ]);
        }
        // DESA DANAU BUNTAR
        Village::factory()->create(['name' => 'Desa Danau Buntar', 'district_id' => 1]);
        for ($i = 1; $i <= 11; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 6,
                'district_id' => 1,
            ]);
        }
        // DESA KEDONDONG
        Village::factory()->create(['name' => 'Desa Kedondong', 'district_id' => 1]);
        for ($i = 1; $i <= 6; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 7,
                'district_id' => 1,
            ]);
        }
        // DESA KENDAWANGAN KANAN
        Village::factory()->create(['name' => 'Desa Kendawangan Kanan', 'district_id' => 1]);
        for ($i = 1; $i <= 6; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 8,
                'district_id' => 1,
            ]);
        }
        // DESA KENDAWANGAN KIRI
        Village::factory()->create(['name' => 'Desa Kendawangan Kiri', 'district_id' => 1]);
        for ($i = 1; $i <= 31; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 9,
                'district_id' => 1,
            ]);
        }
        // DESA KERAMAT JAYA
        Village::factory()->create(['name' => 'Desa Keramat Jaya', 'district_id' => 1]);
        for ($i = 1; $i <= 5; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 10,
                'district_id' => 1,
            ]);
        }
        // DESA MEKAR UTAMA
        Village::factory()->create(['name' => 'Desa Mekar Utama', 'district_id' => 1]);
        for ($i = 1; $i <= 23; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 11,
                'district_id' => 1,
            ]);
        }
        // DESA NATAI KUINI
        Village::factory()->create(['name' => 'Desa Natai Kuini', 'district_id' => 1]);
        for ($i = 1; $i <= 3; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 12,
                'district_id' => 1,
            ]);
        }
        // DESA PANGKALAN BATU
        Village::factory()->create(['name' => 'Desa Pangkalan Batu', 'district_id' => 1]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 13,
                'district_id' => 1,
            ]);
        }
        // DESA PEMBEDILAN
        Village::factory()->create(['name' => 'Desa Pembedilan', 'district_id' => 1]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 14,
                'district_id' => 1,
            ]);
        }
        // DESA SELIMANTAN JAYA
        Village::factory()->create(['name' => 'Desa Selimantan Jaya', 'district_id' => 1]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 15,
                'district_id' => 1,
            ]);
        }
        // DESA SERIAM
        Village::factory()->create(['name' => 'Desa Seriam', 'district_id' => 1]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 16,
                'district_id' => 1,
            ]);
        }
        // DESA SUKA DAMAI
        Village::factory()->create(['name' => 'Suka Damai', 'district_id' => 1]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 17,
                'district_id' => 1,
            ]);
        }
        // DESA SUKA HARAPAN
        Village::factory()->create(['name' => 'Desa Suka Harapan', 'district_id' => 1]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 18,
                'district_id' => 1,
            ]);
        }
        // DESA SUNGAI JELAYAN
        Village::factory()->create(['name' => 'Desa Sungai Jelayan', 'district_id' => 1]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 19,
                'district_id' => 1,
            ]);
        }


        // ------------------------------------------------------------------------------------------

        District::factory()->create(['name' => 'Singkup']);

        // DESA BUKIT KELAMBING
        Village::factory()->create(['name' => 'Desa Bukit Kelambing', 'district_id' => 2]);
        for ($i = 1; $i <= 3; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 20,
                'district_id' => 2,
            ]);
        }
        // DESA MUNTAI
        Village::factory()->create(['name' => 'Desa Muntai', 'district_id' => 2]);
        for ($i = 1; $i <= 3; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 21,
                'district_id' => 2,
            ]);
        }
        // DESA PANTAI KETIKAL
        Village::factory()->create(['name' => 'Desa Pantai Ketikal', 'district_id' => 2]);
        for ($i = 1; $i <= 2; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 22,
                'district_id' => 2,
            ]);
        }
        // DESA SUKA MULIA
        Village::factory()->create(['name' => 'Desa Suka Mulia', 'district_id' => 2]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 23,
                'district_id' => 2,
            ]);
        }
        // DESA SUKA SARI
        Village::factory()->create(['name' => 'Desa Suka Sari', 'district_id' => 2]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 24,
                'district_id' => 2,
            ]);
        }
        // DESA SUKAHARJA
        Village::factory()->create(['name' => 'Desa Sukaharja', 'district_id' => 2]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 25,
                'district_id' => 2,
            ]);
        }
        // DESA SUKARAJA
        Village::factory()->create(['name' => 'Desa Sukaraja', 'district_id' => 2]);
        for ($i = 1; $i <= 5; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 26,
                'district_id' => 2,
            ]);
        }
        // DESA TANAH HITAM
        Village::factory()->create(['name' => 'Desa Tanah Hitam', 'district_id' => 2]);
        for ($i = 1; $i <= 2; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 27,
                'district_id' => 2,
            ]);
        }
    }
}
