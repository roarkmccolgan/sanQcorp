<?php

use Illuminate\Database\Seeder;

class SystemTaskSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		//Waterproofing and Coating of a IBR Roof
		DB::table('system_task')->insert([
			'system_id' => 1,
			'task_id' => 12, //clean
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 1,
			'task_id' => 13, //re-fasten
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 1,
			'task_id' => 14, //waterproof bolt heads
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 1,
			'task_id' => 15, //overlaps
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 1,
			'task_id' => 16, //crosslaps
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 1,
			'task_id' => 17, //perimeter flashing
			'order' => 6
		]);
		DB::table('system_task')->insert([
			'system_id' => 1,
			'task_id' => 18, //coating
			'order' => 7
		]);

		//Waterproofing and Coating of a Klip-Lok Roof
		DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 12, //clean
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 13, //re-fasten
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 15, //overlaps
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 17, //perimeter flashing
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 18, //coating
			'order' => 5
		]);

		//Waterproofing and Coating of a Tile Roof
		DB::table('system_task')->insert([
			'system_id' => 3,
			'task_id' => 12, //clean
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 3,
			'task_id' => 19, //ridging
			'order' => 2
		]);
		
		DB::table('system_task')->insert([
			'system_id' => 3,
			'task_id' => 20, //sidewall
			'order' => 3
		]);

		DB::table('system_task')->insert([
			'system_id' => 3,
			'task_id' => 21, //valleys
			'order' => 4
		]);

		DB::table('system_task')->insert([
			'system_id' => 3,
			'task_id' => 22, //Coating
			'order' => 5
		]);

		//Sanika's Maintenance Free Mineral Torch-on Waterproofing System
		DB::table('system_task')->insert([
			'system_id' => 5,
			'task_id' => 3, //stripping
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 5,
			'task_id' => 7, //screed
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 5,
			'task_id' => 6, //prime
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 5,
			'task_id' => 1, //mineral
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 5,
			'task_id' => 8, //plain
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 5,
			'task_id' => 2, //acrylic
			'order' => 6
		]);

		//Sanika’s Insulative Boarded Waterproofing System on a IBR Roof
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 9, //fillets
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 4, //sanika boards
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 5, //wooden boards
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 10, //galvenisedflashing
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 6, //prime
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 1, //mineral
			'order' => 6
		]);
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 8, //plain
			'order' => 7
		]);
		DB::table('system_task')->insert([
			'system_id' => 10,
			'task_id' => 2, //acrylic
			'order' => 8
		]);

		//Sanika’s Insulative Boarded Waterproofing System on a Corrugated Roof
		DB::table('system_task')->insert([
			'system_id' => 11,
			'task_id' => 4, //sanika boards
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 11,
			'task_id' => 5, //wooden boards
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 11,
			'task_id' => 10, //galvenisedflashing
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 11,
			'task_id' => 6, //prime
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 11,
			'task_id' => 1, //mineral
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 11,
			'task_id' => 8, //plain
			'order' => 6
		]);
		DB::table('system_task')->insert([
			'system_id' => 11,
			'task_id' => 2, //acrylic
			'order' => 7
		]);

		//Sanika’s Insulative Boarded Waterproofing System on a Klip-Lok Roof
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 9, //fillets
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 4, //sanika boards
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 5, //wooden boards
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 10, //galvenisedflashing
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 6, //prime
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 1, //mineral
			'order' => 6
		]);
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 8, //plain
			'order' => 7
		]);
		DB::table('system_task')->insert([
			'system_id' => 12,
			'task_id' => 2, //acrylic
			'order' => 8
		]);

		//THERMO INSULATIVE 
		//Sanika’s Thermo Regulating and Soundproofing Insulative Boarded Waterproofing System on a Concrete Roof
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 7, //screed
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 11, //polyboards
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 4, //sanika boards
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 5, //wooden boards
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 10, //galvenisedflashing
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 6, //prime
			'order' => 6
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 1, //mineral
			'order' => 7
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 8, //plain
			'order' => 8
		]);
		DB::table('system_task')->insert([
			'system_id' => 13,
			'task_id' => 2, //acrylic
			'order' => 9
		]);

		//Sanika’s Thermo Regulating and Soundproofing Insulative Boarded Waterproofing System on a IBR Roof
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 9, //fillets
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 11, //polyboards
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 4, //sanika boards
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 5, //wooden boards
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 10, //galvenisedflashing
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 6, //prime
			'order' => 6
		]);
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 1, //mineral
			'order' => 7
		]);
		DB::table('system_task')->insert([
			'system_id' => 14,
			'task_id' => 8, //plain
			'order' => 8
		]);

		//Kryton Concrete repair and Rejuvination
		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 23, //Chipping
			'order' => 1
		]);
		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 24, //Sandblasting
			'order' => 2
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 25, //Pressure Clean
			'order' => 3
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 26, //Honeycomb
			'order' => 4
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 27, //Plug
			'order' => 5
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 28, //Grout
			'order' => 6
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 29, //Prewet
			'order' => 7
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 30, //t1slurry
			'order' => 8
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 31, //Moist Cure
			'order' => 9
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 32, //T2
			'order' => 10
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
