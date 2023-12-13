<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use App\Models\WebConfig;
use Illuminate\Database\Seeder;

class Dapil1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        District::factory()->create(['name' => 'Delta Pawan']);
        // KELURAHAN KANTOR
        Village::factory()->create(['name' => 'Kelurahan Kantor', 'district_id' => 1]);
        for ($i = 1; $i <= 17; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 1,
                'district_id' => 1,
            ]);
        }
        // KELURAHAN MULIA BARU
        Village::factory()->create(['name' => 'Kelurahan Mulia Baru', 'district_id' => 1]);
        for ($i = 1; $i <= 34; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 2,
                'district_id' => 1,
            ]);
        }
        // KELURAHAN SAMPIT
        Village::factory()->create(['name' => 'Kelurahan Sampit', 'district_id' => 1]);
        for ($i = 1; $i <= 44; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 3,
                'district_id' => 1,
            ]);
        }
        // KELURAHAN SUKAHARJA
        Village::factory()->create(['name' => 'Kelurahan Sukaharja', 'district_id' => 1]);
        for ($i = 1; $i <= 45; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 4,
                'district_id' => 1,
            ]);
        }

        VotingPlace::factory()->create([
            'name' => '901',
            'village_id' => 4,
            'district_id' => 1,
        ]);

        VotingPlace::factory()->create([
            'name' => '902',
            'village_id' => 4,
            'district_id' => 1,
        ]);

        VotingPlace::factory()->create([
            'name' => '903',
            'village_id' => 4,
            'district_id' => 1,
        ]);

        // KELURAHAN TENGAH
        Village::factory()->create(['name' => 'Kelurahan Tengah', 'district_id' => 1]);
        for ($i = 1; $i <= 19; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 5,
                'district_id' => 1,
            ]);
        }

        // DESA KALINILAM
        Village::factory()->create(['name' => 'Desa Kalinilam', 'district_id' => 1]);
        for ($i = 1; $i <= 33; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 6,
                'district_id' => 1,
            ]);
        }
        // DESA PAYA KUMANG
        Village::factory()->create(['name' => 'Desa Paya Kumang', 'district_id' => 1]);
        for ($i = 1; $i <= 18; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 7,
                'district_id' => 1,
            ]);
        }
        // DESA SUKABANGUN
        Village::factory()->create(['name' => 'Desa Sukabangun', 'district_id' => 1]);
        for ($i = 1; $i <= 23; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 8,
                'district_id' => 1,
            ]);
        }
        Village::factory()->create(['name' => 'Desa Sukabangun Dalam', 'district_id' => 1]);
        // DESA SUKABANGUN DALAM
        for ($i = 1; $i <= 11; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 9,
                'district_id' => 1,
            ]);
        }

        // ------------------------------------------------------------------------------------------

        District::factory()->create(['name' => 'Muara Pawan']);
        // DESA SEI AWAN KANAN
        Village::factory()->create(['name' => 'Desa Sei Awan Kanan', 'district_id' => 2]);
        for ($i = 1; $i <= 13; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 10,
                'district_id' => 2,
            ]);
        }
        // DESA SEI AWAN KIRI
        Village::factory()->create(['name' => 'Desa Sei Awan Kiri', 'district_id' => 2]);
        for ($i = 1; $i <= 16; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 11,
                'district_id' => 2,
            ]);
        }
        // DESA SUKAMAJU
        Village::factory()->create(['name' => 'Desa Suka Maju', 'district_id' => 2]);
        for ($i = 1; $i <= 7; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 12,
                'district_id' => 2,
            ]);
        }
        // DESA TANJUNG PASAR
        Village::factory()->create(['name' => 'Desa Tanjung Pasar', 'district_id' => 2]);
        for ($i = 1; $i <= 4; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 13,
                'district_id' => 2,
            ]);
        }
        // DESA MAYAK
        Village::factory()->create(['name' => 'Desa Mayak', 'district_id' => 2]);
        for ($i = 1; $i <= 3; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 14,
                'district_id' => 2,
            ]);
        }
        // DESA TANJUNG PURA
        Village::factory()->create(['name' => 'Desa Tanjung Pura', 'district_id' => 2]);

        VotingPlace::factory()->create([
            'name' => '001',
            'address' => 'SDN 5 MUARA PAWAN',
            'latitude' => -1.7390683,
            'longitude' => 110.210654,
            'village_id' => 15,
            'district_id' => 2,
        ]);

        VotingPlace::factory()->create([
            'name' => '002',
            'address' => 'SDN 5 MUARA PAWAN',
            'latitude' => -1.73906,
            'longitude' => 110.2106167,
            'village_id' => 15,
            'district_id' => 2,
        ]);

        VotingPlace::factory()->create([
            'name' => '003',
            'address' => 'SDN 5 MUARA PAWAN',
            'latitude' => -1.7390895,
            'longitude' => 110.2105901,
            'village_id' => 15,
            'district_id' => 2,
        ]);

        // DESA ULAK MEDANG
        Village::factory()->create(['name' => 'Desa Ulak Medang', 'district_id' => 2]);
        for ($i = 1; $i <= 3; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 16,
                'district_id' => 2,
            ]);
        }
        // DESA TEMPURUKAN
        Village::factory()->create(['name' => 'Desa Tempurukan', 'district_id' => 2]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 17,
                'district_id' => 2,
            ]);
        }

        // ------------------------------------------------------------------------------------------

        District::factory()->create(['name' => 'Matan Hilir Utara']);

        // DESA KUALA SATONG
        Village::factory()->create(['name' => 'Desa Kuala Satong', 'district_id' => 3]);
        for ($i = 1; $i <= 9; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 18,
                'district_id' => 3,
            ]);
        }
        // DESA KUALA TOLAK
        Village::factory()->create(['name' => 'Desa Kuala Tolak', 'district_id' => 3]);
        for ($i = 1; $i <= 14; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 19,
                'district_id' => 3,
            ]);
        }
        // DESA LAMAN SATONG
        Village::factory()->create(['name' => 'Desa Laman Satong', 'district_id' => 3]);
        for ($i = 1; $i <= 11; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 20,
                'district_id' => 3,
            ]);
        }
        // DESA SUNGAI PUTRI
        Village::factory()->create(['name' => 'Desa Sungai Putri', 'district_id' => 3]);
        for ($i = 1; $i <= 8; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 21,
                'district_id' => 3,
            ]);
        }
        // DESA TANJUNG BAIK BUDI
        Village::factory()->create(['name' => 'Desa Tanjung Baik Budi', 'district_id' => 3]);
        for ($i = 1; $i <= 12; $i++) {
            VotingPlace::factory()->create([
                'name' => (strlen($i) != 2) ? '00' . $i : '0' . $i,
                'village_id' => 22,
                'district_id' => 3,
            ]);
        }

        // Voter::truncate();

        // $csvFile = fopen(base_path("database/data/delta-pawan/kelurahan-kantor.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/kelurahan-mulia-baru.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/kelurahan-sampit.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/kelurahan-sukaharja.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/kelurahan-tengah.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/desa-kalinilam.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/desa-paya-kumang.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/desa-sukabangun.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);

        // $csvFile = fopen(base_path("database/data/delta-pawan/desa-sukabangun-dalam.csv"), "r");

        // $firstline = true;
        // while (($data = fgetcsv($csvFile, 20000, ",")) !== FALSE) {
        //     if (!$firstline) {
        //         $date_normalize = str_replace('|', '-', $data['4']);
        //         $create_date = date_create($date_normalize);

        //         $district = District::where('name', $data['14'])->first();
        //         $village = Village::where('name', $data['15'])->first();

        //         $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $data['13'])->first();

        //         Voter::create([
        //             'family_card_number' => $data['0'],
        //             "id_number" => $data['1'],
        //             'name' => ucwords(strtolower($data['2'])),
        //             'birthplace' => ucwords(strtolower($data['3'])),
        //             'birthday' => date_format($create_date, 'Y-m-d'),
        //             'marital_status' => $data['5'],
        //             'gender' => $data['6'],
        //             'address' => ucwords(strtolower($data['7'])),
        //             'rt' => $data['8'],
        //             'rw' => $data['9'],
        //             'district_id' => $district->id,
        //             'village_id' => $village->id,
        //             'voting_place_id' => $voting_place->id,
        //         ]);
        //     }

        //     $firstline = false;
        // }

        // fclose($csvFile);
    }
}
