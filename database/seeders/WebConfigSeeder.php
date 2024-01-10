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
        WebConfig::factory()->create([
            'token' => '0GxB0JURoGbukwlxok6sY9DKhnyjQTvy',
            'name' => 'Apolonius Salim',
            'password' => bcrypt('12341234'),
            'phone_number' => '089528597031',
            'strict' => true,
            'party_id' => 3,
            'candidate_id' => 16,
        ]);
    }
}
