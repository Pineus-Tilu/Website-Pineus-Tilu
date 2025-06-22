<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('area')->insert([
            [
                'name' => 'Pineus Tilu I',
                'description' => 'Area camping Pineus Tilu I.',
                'image_path' => 'pineus1.jpg',
                'extra_charge' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pineus Tilu II',
                'description' => 'Area camping Pineus Tilu II.',
                'image_path' => 'pineus2.jpg',
                'extra_charge' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pineus Tilu III VIP (Tenda)',
                'description' => 'Area camping Pineus Tilu III VIP (Tenda).',
                'image_path' => 'pineus3vip-tenda.jpg',
                'extra_charge' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pineus Tilu III VIP (Kabin)',
                'description' => 'Area camping Pineus Tilu III VIP (Kabin).',
                'image_path' => 'pineus3vip-kabin.jpg',
                'extra_charge' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pineus Tilu IV',
                'description' => 'Area camping Pineus Tilu IV.',
                'image_path' => 'pineus4.jpg',
                'extra_charge' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
