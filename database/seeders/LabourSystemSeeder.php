<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LabourSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Waterproofing and Coating of an IBR Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 1,
            'qty' => 4,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 1,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 1,
        ]);
        //Waterproofing and Coating of a Klip-Lok Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 2,
            'qty' => 4,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 2,
        ]);
        //Waterproofing and Coating of a Tile Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 3,
            'qty' => 4,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 3,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 3,
        ]);
        //Waterproofing and Coating of a Corrugated Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 4,
            'qty' => 4,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 4,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 4,
        ]);
        //Sanika\'s Maintenance Free Mineral Torch-on Waterproofing System
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 5,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 5,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 5,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 5,
        ]);
        //Sanika\'s Heat-bonded, Plain Finish Torch-on Waterproofing System
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 6,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 6,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 6,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 6,
        ]);
        //Sanika\'s Heat-bonded, Dual-Layer Torch-on Waterproofing System
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 7,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 7,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 7,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 7,
        ]);
        //Sanika\'s Heat-bonded, Fibre-Reinforced Torch-on Waterproofing System
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 8,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 8,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 8,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 8,
        ]);
        //Sanika\'s Insulative Boarded Waterproofing System on a Concrete Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 9,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 9,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 9,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 9,
        ]);
        //Sanika’s Insulative Boarded Waterproofing System on a IBR Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 10,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 10,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 10,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 10,
        ]);
        //Sanika\'s Insulative Boarded Waterproofing System on a Corrugated Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 11,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 11,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 11,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 11,
        ]);
        //Sanika\'s Insulative Boarded Waterproofing System on a Klip-Lok Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 12,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 12,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 12,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 12,
        ]);
        //Sanika\'s Thermo Regulating and Sound Proofing Insulative Boarded Waterproofing System on a Concrete Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 13,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 13,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 13,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 13,
        ]);
        //Sanika’s Thermo Regulating and Soundproofing Insulative Boarded Waterproofing System on a IBR Roof
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 14,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 2, // Torcher
            'system_id' => 14,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 14,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 14,
        ]);

        //Kryton Concrete Repair, Waterproofing and Rejuvination
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 15,
            'qty' => 3,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 3, // Builder
            'system_id' => 15,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 15,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 15,
        ]);

        //Kryton Krystol Plaster Waterproofing System
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 16,
            'qty' => 3,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 3, // Builder
            'system_id' => 16,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 16,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 16,
        ]);

        /*//Kryton Waterproof Surface Treatment using Kryton Krystol T1<sup>&reg;</sup> System
        DB::table('labour_system')->insert([
            'labour_id' => 1, // labour
            'system_id' => 17,
            'qty' => 4,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 3, // Builder
            'system_id' => 17,
            'qty' => 2,
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 4, //Driver
            'system_id' => 17
        ]);
        DB::table('labour_system')->insert([
            'labour_id' => 5, // Supervisor
            'system_id' => 17
        ]);*/
    }
}
