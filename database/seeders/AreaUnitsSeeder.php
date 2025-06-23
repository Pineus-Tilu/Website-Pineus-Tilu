<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data area units
        $units = [
            [
                'area_name' => 'Pineus Tilu I',
                'deck' => 9,
                'default' => 4,
                'max' => 6,
            ],
            [
                'area_name' => 'Pineus Tilu II',
                'deck' => 9,
                'default' => 4,
                'max' => 6,
            ],
            [
                'area_name' => 'Pineus Tilu III VIP (Tenda)',
                'deck' => 9,
                'default' => 5,
                'max' => 9,
            ],
            [
                'area_name' => 'Pineus Tilu III VIP (Kabin)',
                'deck' => 1,
                'default' => 2,
                'max' => 5,
            ],
            [
                'area_name' => 'Pineus Tilu IV',
                'deck' => 21,
                'default' => 4,
                'max' => 6,
            ],
        ];

        foreach ($units as $unit) {
            // Ambil area_id berdasarkan nama area
            $area = DB::table('area')->where('name', $unit['area_name'])->first();
            if (!$area) continue;

            // Ambil facility_id pertama untuk area ini
            $facility = DB::table('facility')->where('area_id', $area->id)->first();
            if (!$facility) continue;

            for ($i = 1; $i <= $unit['deck']; $i++) {
                DB::table('area_units')->insert([
                    'facility_id' => $facility->id,
                    'unit_name' => 'Deck ' . $i,
                    'default_people' => $unit['default'],
                    'max_people' => $unit['max'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
