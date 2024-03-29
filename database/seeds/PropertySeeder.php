<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	DB::table('properties')->insert([ //1
		'name' => 'Area',
		'alias' => 'area',
		'uom' => 'm2',
		'created_at' => Carbon::now()
	]);
	DB::table('properties')->insert([ //2
		'name' => 'Perimeter',
		'alias' => 'perimeter',
		'uom' => 'm2',
		'created_at' => Carbon::now()
	]);
	DB::table('properties')->insert([ //3
		'name' => 'Cross Laps',
		'alias' => 'crosslaps',
		'uom' => 'lm',
		'created_at' => Carbon::now()
	]);
	DB::table('properties')->insert([ //4
		'name' => 'Width',
		'alias' => 'width',
		'uom' => 'lm',
		'created_at' => Carbon::now()
	]);
	DB::table('properties')->insert([ //5
		'name' => 'Height',
		'alias' => 'height',
		'uom' => 'lm',
		'created_at' => Carbon::now()
	]);
	DB::table('properties')->insert([ //6
		'name' => 'Volume',
		'alias' => 'volume',
		'uom' => 'm3',
		'created_at' => Carbon::now()
	]);
    }
}
