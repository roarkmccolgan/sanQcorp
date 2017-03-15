<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('tasks')->insert([ //1
			'name' => 'Torching Mineral',
			'description' => 'Install 4,5mm mineral surface maintenance free heat bonded industrial grade torch on waterproofing membrane. If necessary torch into and through box gutters to ensure one complete continuous waterproofing layer incorporating the original roof area and the box gutter into one seamless waterproof structure.',
			'alias' => 'torchmineral',
			'unit_of_measure' => 'm2',
			'rate' => 150,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //2
			'name' => 'Membrane and Acrylic Flashing',
			'description' => 'Terminate all waterproofing, protrusions, up stands and wall to metal roof flashings to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 percent pure acrylic waterproofing compound.',
			'alias' => 'acrylicflashing',
			'unit_of_measure' => 'lm',
			'link_to' => 'perimeter',
			'rate' => 100,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //3
			'name' => 'Stripping',
			'description' => 'Remove obsolete waterproofing membrane from roof area',
			'alias' => 'stripping',
			'unit_of_measure' => 'm2',
			'rate' => 150,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //4
			'name' => 'Boarding Sanika Boards',
			'description' => 'Mechanically install the Sanika pre-manufactured light weight boarded system, comprising of high density fire retardant polystyrene panels adhered, under pressure, to fibre cement fire proof boards.',
			'alias' => 'sanikaboarding',
			'unit_of_measure' => 'm2',
			'rate' => 150,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //5
			'name' => 'Boarding Wooden',
			'description' => 'Mechanically install 16mm marine-grade wooden OSB boards.',
			'alias' => 'woodenboarding',
			'unit_of_measure' => 'm2',
			'rate' => 150,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //6
			'name' => 'Priming Torch-on',
			'description' => 'Prime entire upper surface of newly installed Sanika boards with heat activated bitumous waterproofing primer.',
			'alias' => 'primetorch',
			'unit_of_measure' => 'm2',
			'rate' => 1000,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //7
			'name' => 'Screed Repair',
			'description' => 'Where required, Repair all areas where obsolete screed has been removed using a flexible mortar screed repair system.',
			'alias' => 'screedrepair',
			'unit_of_measure' => 'm2',
			'link_to' => 'area',
			'rate' => 80,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //8
			'name' => 'Torching Plain',
			'description' => 'Install plain, heat bonded, industrial grade torch-on waterproofing membrane.',
			'alias' => 'torchplain',
			'unit_of_measure' => 'm2',
			'rate' => 150,
			'created_at' => Carbon::now()
		]);

		// DB::table('tasks')->insert([ //9
		//     'name' => 'Establish Site',
		//     'description' => 'Establish site and safe working environment',
		//     'alias' => 'establishsite',
		//     'unit_of_measure' => 'days',
		//     'rate' => 0.5,
		//     'created_at' => Carbon::now()
		// ]);
		// DB::table('tasks')->insert([ //10
		//     'name' => 'De-establish Site',
		//     'description' => 'Clean and de-establish site',
		//     'alias' => 'deestablishsite',
		//     'unit_of_measure' => 'days',
		//     'rate' => 0.5,
		//     'created_at' => Carbon::now()
		// ]);

		DB::table('tasks')->insert([ //9
			'name' => 'Install Fillets',
			'description' => 'Install high density, fire retardant polyurethane fillets laser cut to sheet profile for insulation and sound reduction purposes',
			'alias' => 'fillets',
			'unit_of_measure' => 'm2',
			'rate' => 150,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //10
			'name' => 'Install Galvanised Flashing',
			'description' => 'Install Galvanised Flashings where required',
			'alias' => 'galvanisedflashing',
			'unit_of_measure' => 'lm',
			'link_to' => 'perimeter',
			'rate' => 100,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //11
			'name' => 'Install Polyurethane Boards',
			'description' => 'Mechanically and chemically fasten Sanika\'s lightweight, industrial grade, high-density, fire retardant polyurethane insulative panels to roof area.',
			'alias' => 'polyurethaneboards',
			'unit_of_measure' => 'm2',
			'rate' => 400,
			'created_at' => Carbon::now()
		]);

		//IBR Coating
		DB::table('tasks')->insert([ //12
			'name' => 'Clean and prepare',
			'description' => 'Clean entire roof area by means of high pressure rotating needle jet cleaning machines.',
			'alias' => 'cleanibrroof',
			'unit_of_measure' => 'm2',
			'rate' => 400,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //13
			'name' => 'Re-fasten Screws and Bolt Heads',
			'description' => 'Refasten or replace where necessary, all loose and missing screws and bolts',
			'alias' => 'refastenboltsandscrews',
			'unit_of_measure' => 'm2',
			'rate' => 200,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //14
			'name' => 'Waterproof Bolt Heads',
			'description' => 'Waterproof each bolt and screw head using a non-woven polyester waterproofing membrane patch impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'waterproofboltheads',
			'unit_of_measure' => 'm2',
			'rate' => 200,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //15
			'name' => 'Overlaps',
			'description' => 'Waterproof overlaps to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'overlaps',
			'unit_of_measure' => 'm2',
			'link_to' => 'area',
			'rate' => 125,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //16
			'name' => 'Crosslaps',
			'description' => 'Waterproof cross laps to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'crosslaps',
			'unit_of_measure' => 'lm',
			'link_to' => 'perimeter',
			'rate' => 200,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //17
			'name' => 'Perimeter Flashing',
			'description' => 'Waterproof perimeter of roof area to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'perimeter',
			'unit_of_measure' => 'lm',
			'link_to' => 'perimeter',
			'rate' => 200,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //18
			'name' => 'Coating',
			'description' => 'Spray paint entire roof area by using high-pressure airless spraying equipment with UV Stabilised Industrial grade waterproof coating.(5 colours available)',
			'alias' => 'ibrcoat',
			'unit_of_measure' => 'm2',
			'rate' => 400,
			'created_at' => Carbon::now()
		]);
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
