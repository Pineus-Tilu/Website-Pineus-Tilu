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
            ['area_id' => 1, 'description' => '4 Kasur busa + 4 Bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => '4 Kantong tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => '4 Sarapan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Meja Makan Pribadi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Meja Kopi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Terminal Listrik dan Lampu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'BBQ Mini Pribadi (tidak termasuk arang, bahan makanan dan perlengkapan lainnya)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Hammock/Jaring Laba - Laba Pribadi (Deck 1, 2)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Arpenaz Tent Type 4.0 (Deck 3,4,5,6,7)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Arpenaz Tent Type 4.2 (Deck 1,2,8,9)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 1, 'description' => 'Kamar mandi dengan pemanas air', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Meja umum besar', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Api unggun + alat pemanggang api unggun', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Hammock', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Alat panggang BBQ (tidak termasuk arang, bahan makanan, dan perlengkapan lainnya)', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => 'Air minum & dispenser', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 1, 'description' => '4 Toilet Jongkok', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu II (area_id = 2) - sama dengan I
        DB::table('facility')->insert([
            // Fasilitas Pribadi
            ['area_id' => 2, 'description' => '4 Kasur busa + 4 Bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => '4 Kantong tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => '4 Sarapan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Meja Makan Pribadi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Meja Kopi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Terminal Listrik dan Lampu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'BBQ Mini Pribadi (tidak termasuk arang, bahan makanan dan perlengkapan lainnya)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Hammock/Jaring Laba - Laba Pribadi (Deck 1, 2)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Arpenaz Tent Type 4.0 (Deck 3,4,5,6,7)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Arpenaz Tent Type 4.2 (Deck 1,2,8,9)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 2, 'description' => 'Kamar mandi dengan pemanas air', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Meja umum besar', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Api unggun + alat pemanggang api unggun', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Hammock', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Alat panggang BBQ (tidak termasuk arang, bahan makanan, dan perlengkapan lainnya)', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => 'Air minum & dispenser', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 2, 'description' => '4 Toilet Jongkok', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu III VIP (Tenda) (area_id = 3)
        DB::table('facility')->insert([
            // Fasilitas Pribadi
            ['area_id' => 3, 'description' => '5 Kasur busa + 5 Bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '5 Kantong tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '5 Sarapan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '5 Handuk, 5 Pasta Gigi dan Sikat Gigi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Meja makan panjang dan mewah dari kayu solid (80 – 85 cm x 2,5 m)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '6 Kursi rotan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Hammock jaring / Hammock laba-laba', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '2 Hammock ayunan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Lampu, lampu gantung, dan lampu meja', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Pantry dengan meja dan wastafel dari kayu solid', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Kulkas / Freezer', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Galon air minum & dispenser', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Kursi gym', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '5 Terminal listrik', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Alat panggangan BBQ, termasuk arang dan kipas', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Tempat sampah rotan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Tenda tipe keluarga 5.2, sirkulasi udara segar dan lapisan dalam hitam', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Karpet, 5 bantal duduk', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '2 Beanbag', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '2 lampu meja', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Meja kopi dari kayu solid, meja konsol', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Gantungan baju berdiri', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Alas lantai indoor dan outdoor', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Meja bar dan 5 blok kayu duduk', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => '1 Terminal listrik', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Tempat sampah rotan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Kamar mandi pribadi, kloset, cermin', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Shower dengan air hangat', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Gantungan handuk/pakaian', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Sampo, Sabun', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Wastafel Batu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 3, 'description' => 'Meja makan dari kayu solid mewah sepanjang 5 meter dengan wastafel', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Bangku', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Tempat sampah dari rotan', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Api unggun dan alat pemanggang', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Kayu gelondongan untuk duduk', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Lampu luar ruangan', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Patung-patung kayu', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Pagar dan pintu', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Kayu bakar / bahan bakar untuk api unggun', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 3, 'description' => 'Wifi & CCTV', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu III VIP (Kabin) (area_id = 4)
        DB::table('facility')->insert([
            // Fasilitas Pribadi (Kabin)
            ['area_id' => 4, 'description' => 'Kasur King 180 x 200 cm dengan 4 bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '3 Kasur busa tambahan + sleeping bag', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '3 Lampu malam / lampu tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Sofa dengan 2 bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Meja kopi dari kayu solid', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Rak gantungan baju berdiri', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Meja konsol dari kayu solid (600 cm x 40 cm)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Dispenser + galon', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '4 Terminal listrik', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Smart TV', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Wifi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Meja makan mewah dari kayu solid', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '6 Kursi rotan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '4 Kayu log duduk', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Peralatan BBQ dengan arang', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '2 Lampu gantung yang indah', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Teras mengambang dengan atap', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Meja pantry dari kayu solid', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Wastafel bundar', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Kulkas', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Kompor portable', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Wajan BBQ', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Listrik', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '5 Sikat gigi + pasta gigi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Bak mandi berdiri', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Shower air hangat', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Kipas pembuangan udara', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Lemari pakaian', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => '5 Handuk', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 4, 'description' => 'Sampo + sabun', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pineus Tilu IV (area_id = 5)
        DB::table('facility')->insert([
            // Fasilitas Pribadi
            ['area_id' => 5, 'description' => '4 Kasur busa + 4 Bantal', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => '4 Kantong tidur', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => '4 Sarapan', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Meja Makan Pribadi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Meja Kopi', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Terminal Listrik dan Lampu', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'BBQ Mini Pribadi (tidak termasuk arang, bahan makanan dan perlengkapan lainnya)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Semua Deck menggunakan tenda Arpenaz Type 4.2 (1-21)', 'type' => 'pribadi', 'created_at' => now(), 'updated_at' => now()],
            // Fasilitas Umum
            ['area_id' => 5, 'description' => 'Kamar mandi dengan pemanas air', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Meja makan besar dari kayu solid', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Api unggun besar dari kayu solid', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => '3 Ayunan', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Puluhan pohon pinus dengan lampu', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Hammock', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Area dapur & meja kayu', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Air minum & dispenser', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => '8 Meja kayu & blok kayu', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => '8 Toilet (4 Duduk + 4 Jongkok)', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['area_id' => 5, 'description' => 'Ruang pertemuan dengan kapasitas hingga 80 orang', 'type' => 'umum', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
