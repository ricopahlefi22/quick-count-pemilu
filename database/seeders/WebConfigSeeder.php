<?php

namespace Database\Seeders;

use App\Models\WebConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // WebConfig::factory()->create([
        //     'token' => 'XR9154bgT7ZS1Nk38RYb2WnEEe5pfsfSnpVu5M1y2gV9L1CZ34',
        //     'name' => 'Apolonius Salim',
        //     'password' => bcrypt('12341234'),
        //     'phone_number' => '089528597031',
        //     'strict' => true,
        //     'party_id' => 3,
        //     'candidate_id' => 16,
        // ]);

        WebConfig::factory()->create([
            'token' => 'XR9154bgT7ZS1Nk38RYb2WnEEe5pfsfSnpVu5M1y2gV9L1CZ34',
            'name' => 'Y. Agung R.',
            'password' => bcrypt('12341234'),
            'phone_number' => '089528597031',
            'strict' => true,
            'party_id' => 14,
            'candidate_id' => 41,
        ]);
    }
}
