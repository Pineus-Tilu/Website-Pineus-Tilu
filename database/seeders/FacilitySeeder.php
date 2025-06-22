<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pineus Tilu I (area_id = 1)
        DB::table('facility')->insert([
            // Fasilitas Pribadi
            ['area_id' => 1, 'description' => '4 Kursi tamu + 4 Bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => '4 Kasur tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Meja Kayu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Colokan listrik dan lampu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Tenda dome 4–6 orang', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 1, 'description' => 'Kamar mandi dengan pemanas air', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Musholla umum', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Alat panggang BBQ', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Alat makan & dispenser', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Toilet jongkok', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu II (area_id = 2)
        DB::table('facility')->insert([
            // Fasilitas Pribadi
            ['area_id' => 2, 'description' => '4 Kursi busa + 4 Bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => '4 Kasur tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Meja Makan Pribadi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Terminal listrik dan lampu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Tenda dome 4–6 orang', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 2, 'description' => 'Kamar mandi dengan pemanas air', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Musholla umum besar', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Hammock', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Area komunal api unggun', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Toilet jongkok dan duduk', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu III VIP (Tenda) (area_id = 3)
        DB::table('facility')->insert([
            // Fasilitas Tenda
            ['area_id' => 3, 'description' => 'Kursi tamu dan meja', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '4 Kasur busa + 4 bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Lampu dan colokan listrik', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Tenda besar anti air', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 3, 'description' => 'Area api unggun', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Toilet umum jongkok dan duduk', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Area dapur bersama', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu III VIP (Kabin) (area_id = 4)
        DB::table('facility')->insert([
            // Fasilitas Kabin
            ['area_id' => 4, 'description' => 'Kabin dengan spring bed & guling', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Meja makan dalam kabin', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Kamar mandi dalam', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 4, 'description' => 'Area hammock & api unggun', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Area dapur dan tempat makan bersama', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Toilet jongkok dan duduk', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu IV (area_id = 5)
        DB::table('facility')->insert([
            // Fasilitas Pribadi
            ['area_id' => 5, 'description' => '4 Kursi busa + 4 Bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => '4 Kasur tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Meja Makan Pribadi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Terminal listrik dan lampu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Tenda dome 4–6 orang', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 5, 'description' => 'Kamar mandi dengan pemanas air', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Musholla umum besar', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Area hammock & api unggun', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Area dapur dan tempat makan bersama', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Toilet jongkok dan duduk', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
