<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'photo' => 'storage/init-images/rico.jpg',
            'name' => 'Rico Pahlefi',
            'email' => 'ricopahlefi22@gmail.com',
            'phone_number' => '089528597031',
            'level' => true,
            'password' => bcrypt('MudahDitebak123!'),
        ]);

        Admin::factory()->create([
            'photo' => 'storage/init-images/sherin.jpg',
            'name' => 'Sherin',
            'email' => 'sherinpramestirc@gmail.com',
            'phone_number' => '081258785644',
            'level' => false,
            'password' => bcrypt('12341234'),
        ]);

        Admin::factory()->create([
            'photo' => 'storage/init-images/sherly.jpg',
            'name' => 'Serly',
            'email' => 'serlyaura92@gmail.com',
            'phone_number' => '081348741607',
            'level' => false,
            'password' => bcrypt('12341234'),
        ]);
    }
}
