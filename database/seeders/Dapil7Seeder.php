<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use App\Models\VotingPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Dapil7Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::factory()->create(['name' => 'Benua Kayong']);
        // KELURAHAN MULIA KERTA
        Village::factory()->create(['name' => 'Kelurahan Mulia Kerta', 'district_id' => 1]);
        for ($i = 1; $i <= 24; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 1,
                'district_id' => 1,
            ]);
        }
        // KELURAHAN KAUMAN
        Village::factory()->create(['name' => 'Kelurahan Kauman', 'district_id' => 1]);
        for ($i = 1; $i <= 17; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 2,
                'district_id' => 1,
            ]);
        }
        // DESA TUAN-TUAN
        Village::factory()->create(['name' => 'Desa Tuan-Tuan', 'district_id' => 1]);
        for ($i = 1; $i <= 16; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 3,
                'district_id' => 1,
            ]);
        }
        // DESA SUNGAI KINJIL
        Village::factory()->create(['name' => 'Desa Sungai Kinjil', 'district_id' => 1]);
        for ($i = 1; $i <= 7; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 4,
                'district_id' => 1,
            ]);
        }

        // DESA SUKA BARU
        Village::factory()->create(['name' => 'Desa Suka Baru', 'district_id' => 1]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 5,
                'district_id' => 1,
            ]);
        }

        // DESA PADANG
        Village::factory()->create(['name' => 'Desa Padang', 'district_id' => 1]);
        for ($i = 1; $i <= 12; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 6,
                'district_id' => 1,
            ]);
        }
        // DESA NEGERI BARU
        Village::factory()->create(['name' => 'Desa Negeri Baru', 'district_id' => 1]);
        for ($i = 1; $i <= 9; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 7,
                'district_id' => 1,
            ]);
        }
        // DESA MEKAR SARI
        Village::factory()->create(['name' => 'Desa Mekar Sari', 'district_id' => 1]);
        for ($i = 1; $i <= 10; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 8,
                'district_id' => 1,
            ]);
        }
        // DESA KINJIL PESISIR
        Village::factory()->create(['name' => 'Desa Kinjil Pesisir', 'district_id' => 1]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 9,
                'district_id' => 1,
            ]);
        }
        // DESA BARU
        Village::factory()->create(['name' => 'Desa Baru', 'district_id' => 1]);
        for ($i = 1; $i <= 13; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 10,
                'district_id' => 1,
            ]);
        }
        // DESA BANJAR
        Village::factory()->create(['name' => 'Desa Banjar', 'district_id' => 1]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 11,
                'district_id' => 1,
            ]);
        }

        // ------------------------------------------------------------------------------------------

        District::factory()->create(['name' => 'Matan Hilir Selatan']);

        // DESA HARAPAN BARU
        Village::factory()->create(['name' => 'Desa Harapan Baru', 'district_id' => 2]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 12,
                'district_id' => 2,
            ]);
        }
        // DESA KEMUNING BIUTAK
        Village::factory()->create(['name' => 'Desa Kemuning Biutak', 'district_id' => 2]);
        for ($i = 1; $i <= 5; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 13,
                'district_id' => 2,
            ]);
        }
        // DESA PAGAR MENTIMUN
        Village::factory()->create(['name' => 'Desa Pagar Mentimun', 'district_id' => 2]);
        for ($i = 1; $i <= 2; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 14,
                'district_id' => 2,
            ]);
        }
        // DESA PEMATANG GADUNG
        Village::factory()->create(['name' => 'Desa Pematang Gadung', 'district_id' => 2]);
        for ($i = 1; $i <= 9; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 15,
                'district_id' => 2,
            ]);
        }
        // DESA PESAGUAN KANAN
        Village::factory()->create(['name' => 'Desa Pesaguan Kanan', 'district_id' => 2]);
        for ($i = 1; $i <= 16; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 16,
                'district_id' => 2,
            ]);
        }
        // DESA PESAGUAN KIRI
        Village::factory()->create(['name' => 'Desa Pesaguan Kiri', 'district_id' => 2]);
        for ($i = 1; $i <= 10; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 17,
                'district_id' => 2,
            ]);
        }
        // DESA SUNGAI BAKAU
        Village::factory()->create(['name' => 'Desa Sungai Bakau', 'district_id' => 2]);
        for ($i = 1; $i <= 9; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 18,
                'district_id' => 2,
            ]);
        }
        // DESA SUNGAI BESAR
        Village::factory()->create(['name' => 'Desa Sungai Besar', 'district_id' => 2]);
        for ($i = 1; $i <= 15; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 19,
                'district_id' => 2,
            ]);
        }
        // DESA SUNGAI JAWI
        Village::factory()->create(['name' => 'Desa Sungai Jawi', 'district_id' => 2]);
        for ($i = 1; $i <= 10; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 20,
                'district_id' => 2,
            ]);
        }
        // DESA SUNGAI NANJUNG
        Village::factory()->create(['name' => 'Desa Sungai Nanjung', 'district_id' => 2]);
        for ($i = 1; $i <= 12; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 21,
                'district_id' => 2,
            ]);
        }
        // DESA SUNGAI PELANG
        Village::factory()->create(['name' => 'Desa Sungai Pelang', 'district_id' => 2]);
        for ($i = 1; $i <= 20; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 22,
                'district_id' => 2,
            ]);
        }
    }
}
