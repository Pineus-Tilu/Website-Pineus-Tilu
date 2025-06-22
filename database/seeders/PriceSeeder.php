<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pineus Tilu I
        $units = DB::table('area_units')
            ->join('facility', 'area_units.facility_id', '=', 'facility.id')
            ->join('area', 'facility.area_id', '=', 'area.id')
            ->where('area.name', 'Pineus Tilu I')
            ->select('area_units.id', 'unit_name')
            ->get();

        foreach ($units as $unit) {
            if (in_array($unit->unit_name, ['Deck 3', 'Deck 4', 'Deck 5', 'Deck 6', 'Deck 7'])) {
                // Tenda 4.0
                DB::table('price')->insert([
                    'unit_id' => $unit->id,
                    'Weekday' => 650000,
                    'Weekend' => 900000,
                    'High_season' => 1100000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Tenda 4.2
                DB::table('price')->insert([
                    'unit_id' => $unit->id,
                    'Weekday' => 750000,
                    'Weekend' => 950000,
                    'High_season' => 1100000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Pineus Tilu II
        $units = DB::table('area_units')
            ->join('facility', 'area_units.facility_id', '=', 'facility.id')
            ->join('area', 'facility.area_id', '=', 'area.id')
            ->where('area.name', 'Pineus Tilu II')
            ->select('area_units.id', 'unit_name')
            ->get();

        foreach ($units as $unit) {
            if (in_array($unit->unit_name, ['Deck 1', 'Deck 2', 'Deck 3', 'Deck 4', 'Deck 5', 'Deck 6'])) {
                // Tenda 4.0
                DB::table('price')->insert([
                    'unit_id' => $unit->id,
                    'Weekday' => 650000,
                    'Weekend' => 900000,
                    'High_season' => 1100000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Tenda 4.2
                DB::table('price')->insert([
                    'unit_id' => $unit->id,
                    'Weekday' => 750000,
                    'Weekend' => 950000,
                    'High_season' => 1100000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Pineus Tilu III VIP (Tenda)
        $units = DB::table('area_units')
            ->join('facility', 'area_units.facility_id', '=', 'facility.id')
            ->join('area', 'facility.area_id', '=', 'area.id')
            ->where('area.name', 'Pineus Tilu III VIP (Tenda)')
            ->select('area_units.id', 'unit_name')
            ->get();

        foreach ($units as $unit) {
            DB::table('price')->insert([
                'unit_id' => $unit->id,
                'Weekday' => 1500000,
                'Weekend' => 1900000,
                'High_season' => 2200000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Pineus Tilu III VIP (Kabin)
        $units = DB::table('area_units')
            ->join('facility', 'area_units.facility_id', '=', 'facility.id')
            ->join('area', 'facility.area_id', '=', 'area.id')
            ->where('area.name', 'Pineus Tilu III VIP (Kabin)')
            ->select('area_units.id', 'unit_name')
            ->get();

        foreach ($units as $unit) {
            DB::table('price')->insert([
                'unit_id' => $unit->id,
                'Weekday' => 1500000,
                'Weekend' => 1900000,
                'High_season' => 2200000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Pineus Tilu IV
        $units = DB::table('area_units')
            ->join('facility', 'area_units.facility_id', '=', 'facility.id')
            ->join('area', 'facility.area_id', '=', 'area.id')
            ->where('area.name', 'Pineus Tilu IV')
            ->select('area_units.id', 'unit_name')
            ->get();

        foreach ($units as $unit) {
            DB::table('price')->insert([
                'unit_id' => $unit->id,
                'Weekday' => 750000,
                'Weekend' => 950000,
                'High_season' => 1100000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
