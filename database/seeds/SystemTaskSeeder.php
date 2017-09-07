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
		/*DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 13, //re-fasten
			'order' => 2
		]);*/
		DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 16, //crosslaps
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 2,
			'task_id' => 42, //overlaps
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

		//Waterproofing and Coating of a Corrugated Roof
		DB::table('system_task')->insert([
			'system_id' => 4,
			'task_id' => 12, //clean
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 4,
			'task_id' => 19, //ridging
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 4,
			'task_id' => 15, //overlaps
			'order' => 3
		]);

		DB::table('system_task')->insert([
			'system_id' => 4,
			'task_id' => 16, //crosslaps
			'order' => 4
		]);
		
		DB::table('system_task')->insert([
			'system_id' => 4,
			'task_id' => 20, //sidewall
			'order' => 5
		]);

		DB::table('system_task')->insert([
			'system_id' => 4,
			'task_id' => 23, //Coating
			'order' => 6
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
			'task_id' => 2, //acrylic
			'order' => 5
		]);

		//Sanika's Heat-bonded, Plain Finish Torch-on Waterproofing System
		DB::table('system_task')->insert([
			'system_id' => 6,
			'task_id' => 3, //stripping
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 6,
			'task_id' => 7, //screed
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 6,
			'task_id' => 6, //prime
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 6,
			'task_id' => 8, //plain
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 6,
			'task_id' => 43, //silverkote
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 6,
			'task_id' => 2, //acrylic
			'order' => 6
		]);

		//Sanika\'s Heat-bonded, Dual-Layer Torch-on Waterproofing System
		DB::table('system_task')->insert([
			'system_id' => 7,
			'task_id' => 3, //stripping
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 7,
			'task_id' => 7, //screed
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 7,
			'task_id' => 6, //prime
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 7,
			'task_id' => 8, //torch plain
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 7,
			'task_id' => 1, //torch Mineral
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 7,
			'task_id' => 2, //acrylic
			'order' => 5
		]);

		//Sanika\'s Heat-bonded, Fibre-Reinforced Torch-on Waterproofing System
		DB::table('system_task')->insert([
			'system_id' => 8,
			'task_id' => 3, //stripping
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 8,
			'task_id' => 7, //screed
			'order' => 2
		]);
		DB::table('system_task')->insert([
			'system_id' => 8,
			'task_id' => 6, //prime
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 8,
			'task_id' => 35,  //Fibre Reinforced?
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 8,
			'task_id' => 2, //acrylic
			'order' => 5
		]);

		//Sanika’s Insulative Boarded Waterproofing System on a Concrete Roof
		
		DB::table('system_task')->insert([
			'system_id' => 9,
			'task_id' => 4, //sanika boards
			'order' => 1
		]);
		DB::table('system_task')->insert([
			'system_id' => 9,
			'task_id' => 5, //wooden boards
			'order' => 2
		]);
		
		DB::table('system_task')->insert([
			'system_id' => 9,
			'task_id' => 6, //prime
			'order' => 3
		]);
		DB::table('system_task')->insert([
			'system_id' => 9,
			'task_id' => 1, //mineral
			'order' => 4
		]);
		DB::table('system_task')->insert([
			'system_id' => 9,
			'task_id' => 8, //plain
			'order' => 5
		]);
		DB::table('system_task')->insert([
			'system_id' => 9,
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
			'task_id' => 24, //Open Crack
			'order' => 1
		]);
		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 25, //Open Tie Holes
			'order' => 2
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 26, //Opening Honeycombing
			'order' => 3
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 27, //Sandblasting
			'order' => 4
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 28, //Pressure Clean
			'order' => 5
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 29, //Plug 
			'order' => 6
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 30, //Close Crack
			'order' => 7
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 31, //Close Honeycombing
			'order' => 8
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 32, //Close Tie-Holes
			'order' => 8
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 33, //Pre-wet
			'order' => 8
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 34, //t1slurry
			'order' => 8
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 35, //Moist Cure
			'order' => 9
		]);

		DB::table('system_task')->insert([ // 
			'system_id' => 15,
			'task_id' => 36, //T2
			'order' => 10
		]);

		//Kryton KMA
		DB::table('system_task')->insert([ // 
			'system_id' => 16,
			'task_id' => 37, //chipping
			'order' => 1
		]);
		DB::table('system_task')->insert([ // 
			'system_id' => 16,
			'task_id' => 38, //plaster KMA
			'order' => 2
		]);
		DB::table('system_task')->insert([ // 
			'system_id' => 16,
			'task_id' => 39, //Alkali Primer
			'order' => 3
		]);
		
		DB::table('system_task')->insert([ // 
			'system_id' => 16,
			'task_id' => 40, //Undercoat
			'order' => 5
		]);
		DB::table('system_task')->insert([ // 
			'system_id' => 16,
			'task_id' => 41, //Coating
			'order' => 6
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
