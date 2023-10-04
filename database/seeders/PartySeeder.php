<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Party::factory()->create([
            'logo' => 'images/party/partai-pkb.png',
            'name' => 'Partai Kebangkitan Bangsa',
            'serial_number' => 1,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-gerindra.png',
            'name' => 'Partai Gerindra',
            'serial_number' => 2,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/pdi-perjuangan.png',
            'name' => 'PDI Perjuangan',
            'serial_number' => 3,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-golkar.png',
            'name' => 'Partai Golongan Karya',
            'serial_number' => 4,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-nasdem.png',
            'name' => 'Partai Nasdem',
            'serial_number' => 5,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-buruh.png',
            'name' => 'Partai Buruh',
            'serial_number' => 6,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-gelora-indonesia.png',
            'name' => 'Partai Gelora Indonesia',
            'serial_number' => 7,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-pks.png',
            'name' => 'Partai Keadilan Sejahtera',
            'serial_number' => 8,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-pkn.png',
            'name' => 'Partai Kebangkitan Nusantara',
            'serial_number' => 9,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-hanura.png',
            'name' => 'Partai Hanura',
            'serial_number' => 10,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-garuda.png',
            'name' => 'Partai Garuda',
            'serial_number' => 11,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-pan.png',
            'name' => 'Partai Amanat Nasional',
            'serial_number' => 12,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-bulan-bintang.png',
            'name' => 'Partai Bulan Bintang',
            'serial_number' => 13,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-demokrat.png',
            'name' => 'Partai Demokrat',
            'serial_number' => 14,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-psi.png',
            'name' => 'Partai Solidaritas Indonesia',
            'serial_number' => 15,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-perindo.png',
            'name' => 'Partai Perindo',
            'serial_number' => 16,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-ppp.png',
            'name' => 'Partai Persatuan Pembangunan',
            'serial_number' => 17,
        ]);

        Party::factory()->create([
            'logo' => 'images/party/partai-ummat.png',
            'name' => 'Partai Ummat',
            'serial_number' => 24,
        ]);
    }
}
