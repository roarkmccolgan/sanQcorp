<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name' => 'Waterproofing'
        ]);
        DB::table('category')->insert([
            'name' => 'Cementitious'
        ]);
        DB::table('category')->insert([
            'name' => 'Sand'
        ]);
    }
}
