<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'Rico Pahlefi',
            'username' => 'rico22',
            'phone_number' => '6289528597031',
            'level' => true,
            'password' => bcrypt('MudahDitebak123!'),
        ]);

        Admin::factory()->create([
            'name' => 'Sherin Pramesti',
            'username' => 'sherin',
            'phone_number' => '6281258785644',
            'level' => true,
            'password' => bcrypt('nyamanngomong'),
        ]);

        Admin::factory()->create([
            'name' => 'Serly',
            'username' => 'serly',
            'phone_number' => '6281348741607',
            'level' => false,
            'password' => bcrypt('nyamanngomong'),
        ]);

        Admin::factory()->create([
            'name' => 'Dwi Indra Kusuma',
            'username' => 'dwi',
            'phone_number' => '6281348110313',
            'level' => false,
            'password' => bcrypt('nyamanngomong'),
        ]);
    }
}
