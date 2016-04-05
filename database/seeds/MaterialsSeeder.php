<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('materials')->insert([
            'name' => 'Coppernit Mineral Torch-on',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'price' => 660.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'm2',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([
            'name' => 'ABE Bitu-Prime',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 25,
            'price' => 460.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'Lt',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([
            'name' => 'Gas 9kg',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'price' => 186.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'Lt',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([
            'name' => 'Membrane 200',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 9,
            'price' => 31.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'created_at' => Carbon::now()
        ]);
        DB::table('materials')->insert([
            'name' => 'Super Laycryl',
            'category_id' => 1,
            'description' => 'Blah Blah',
            'image' => 'blank.jpg',
            'stock' => 1000,
            'pack_size' => 20,
            'price' => 31.00,
            'day_rate' => 0.00,
            'unit_of_measure' => 'lm',
            'created_at' => Carbon::now()
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}