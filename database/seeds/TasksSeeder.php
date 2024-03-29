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
			'rate' => 200,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //4
			'name' => 'Boarding Sanika Boards',
			'description' => 'Mechanically install the Sanika pre-manufactured light weight boarded system, comprising of high density fire retardant polystyrene panels adhered, under pressure, to fibre cement fire proof boards.',
			'alias' => 'sanikaboarding',
			'unit_of_measure' => 'm2',
			'rate' => 100,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //5
			'name' => 'Boarding Wooden',
			'description' => 'Mechanically install 16mm marine-grade wooden OSB boards.',
			'alias' => 'woodenboarding',
			'unit_of_measure' => 'm2',
			'rate' => 100,
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

		DB::table('tasks')->insert([ //9
			'name' => 'Install Fillets',
			'description' => 'Install high density, fire retardant polyurethane fillets laser cut to sheet profile for insulation and sound reduction purposes',
			'alias' => 'fillets',
			'unit_of_measure' => 'm2',
			'rate' => 1000,
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
			'rate' => 100,
			'created_at' => Carbon::now()
		]);

		//IBR Coating
		DB::table('tasks')->insert([ //12
			'name' => 'Clean and prepare',
			'description' => 'Clean entire roof area by means of high pressure rotating needle jet cleaning machines.',
			'alias' => 'cleanibrroof',
			'unit_of_measure' => 'm2',
			'rate' => 1300,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //13
			'name' => 'Re-fasten Screws and Bolt Heads',
			'description' => 'Refasten or replace where necessary, all loose and missing screws and bolts',
			'alias' => 'refastenboltsandscrews',
			'unit_of_measure' => 'm2',
			'rate' => 5200,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //14
			'name' => 'Waterproof Bolt Heads',
			'description' => 'Waterproof each bolt and screw head using a non-woven polyester waterproofing membrane patch impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'waterproofboltheads',
			'unit_of_measure' => 'm2',
			'rate' => 1452,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //15
			'name' => 'Overlaps',
			'description' => 'Waterproof overlaps to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'overlaps',
			'unit_of_measure' => 'm2',
			'link_to' => 'area',
			'rate' => 250,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //16
			'name' => 'Crosslaps',
			'description' => 'Waterproof cross laps to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'crosslaps',
			'unit_of_measure' => 'lm',
			'link_to' => 'crosslaps',
			'rate' => 240,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //17
			'name' => 'Perimeter Flashing',
			'description' => 'Waterproof perimeter of roof area to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'perimeter',
			'unit_of_measure' => 'lm',
			'link_to' => 'perimeter',
			'rate' => 240,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //18
			'name' => 'Coating',
			'description' => 'Spray paint entire roof area by using high-pressure airless spraying equipment with UV Stabilised Industrial grade waterproof coating.(5 colours available)',
			'alias' => 'ibrcoat',
			'unit_of_measure' => 'm2',
			'rate' => 500,
			'created_at' => Carbon::now()
		]);

		//tile roof
		DB::table('tasks')->insert([ //19
			'name' => 'Ridging',
			'description' => 'Waterproof ridging to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'tileridge',
			'unit_of_measure' => 'lm',
			'link_to' => 'ridge',
			'rate' => 180,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //20
			'name' => 'Sidewall',
			'description' => 'Waterproof sidewalls to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'sidewall',
			'unit_of_measure' => 'lm',
			'link_to' => 'sidewall',
			'rate' => 142,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //21
			'name' => 'Valleys',
			'description' => 'Remove tiles along valley edges and fit 1m wide flashing detail from ridge to roof edge. Re-fit tiles',
			'alias' => 'valley',
			'unit_of_measure' => 'lm',
			'link_to' => 'valleys',
			'rate' => 50,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //22
			'name' => 'Coating',
			'description' => 'Spray paint entire roof area by using high-pressure airless spraying equipment with UV Stabilised Industrial grade waterproof coating.(5 colours available)',
			'alias' => 'tilecoat',
			'unit_of_measure' => 'm2',
			'rate' => 500,
			'created_at' => Carbon::now()
		]);

		//corrugated roof

		DB::table('tasks')->insert([ //23
			'name' => 'Coating',
			'description' => 'Spray paint entire roof area by using high-pressure airless spraying equipment with UV Stabilised Industrial grade waterproof coating.(5 colours available)',
			'alias' => 'corrucoat',
			'unit_of_measure' => 'm2',
			'rate' => 500,
			'created_at' => Carbon::now()
		]);

		//Kryton
		//Kryton Concrete Repair
		DB::table('tasks')->insert([ //24
			'name' => 'Opening Crack',
			'description' => 'Using a sharp 25 mm, square chisel, HILTI high speed chisellers chip a chase along the entire length of the water ingress points to',
			'alias' => 'opencrack',
			'unit_of_measure' => 'lm',
			'link_to' => 'crack',
			'rate' => 100,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //25
			'name' => 'Opening Tie Holes',
			'description' => 'Using a sharp 25 mm, square chisel, HILTI high speed chisellers chip open all tie-holes showing signs of water ingress or degress',
			'alias' => 'opentiehole',
			'unit_of_measure' => 'each',
			'link_to' => 'tieholes',
			'rate' => 200,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //26
			'name' => 'Open Honeycombing',
			'description' => 'Using a sharp 25 mm, square chisel, HILTI high speed chisellers expose areas of honecombing until solid concrete is left',
			'alias' => 'openhoneycomb',
			'unit_of_measure' => 'm2',
			'link_to' => 'honeycomb',
			'rate' => 35,
			'created_at' => Carbon::now()
		]);
		
		DB::table('tasks')->insert([ //27
			'name' => 'Sandblasting',
			'description' => 'Clean and prepare surface using dustless sand blasting to ensure the pores of the concrete are exposed to allow the growth of “Krystols” into the concrete. (please note that this process is highly important for the success of crystalline repairs, if the pores are not adequately exposed there will be failures)',
			'alias' => 'sandblasting',
			'unit_of_measure' => 'm2',
			'rate' => 329,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //28
			'name' => 'Pressure Clean',
			'description' => 'Clean and prepare substrate using high pressure water washers with rotating needle jets. (please note that this process is highly important for the success of crystalline repairs, if the pores are not adequately exposed there will be failures)',
			'alias' => 'clean',
			'unit_of_measure' => 'm2',
			'rate' => 800,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //29
			'name' => 'Plug',
			'description' => 'Stop water flow with Kryton Plug',
			'alias' => 'plug',
			'unit_of_measure' => 'lm',
			'link_to' => 'plug',
			'rate' => 20,
			'created_at' => Carbon::now()
		]);		

		DB::table('tasks')->insert([ //30
			'name' => 'Close Crack',
			'description' => 'Clean the chase with clean water, removing all dust and loose concrete and fill the chased area with Kryton Krystol Repair Grout<sup>&reg;</sup> (specially mixed dry-mix)',
			'alias' => 'grout',
			'unit_of_measure' => 'lm',
			'link_to' => 'crack',
			'rate' => 150,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //31
			'name' => 'Close Honeycombing',
			'description' => 'Clean the chase with clean water, removing all dust and loose concrete and fill the chased area with Kryton Krystol Repair Grout<sup>&reg;</sup> (specially mixed dry-mix)',
			'alias' => 'closehoneycomb',
			'unit_of_measure' => 'm2',
			'link_to' => 'honeycomb',
			'rate' => 5,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //32
			'name' => 'Close Tie-Holes',
			'description' => 'Clean the chase with clean water, removing all dust and loose concrete and fill the chased area with Kryton Krystol Repair Grout<sup>&reg;</sup> (specially mixed dry-mix)',
			'alias' => 'closetiehole',
			'unit_of_measure' => 'each',
			'link_to' => 'tieholes',
			'rate' => 100,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //33
			'name' => 'Pre-wet',
			'description' => 'Pre-wet surface to be treated to Saturate-Surface- Dry (SSD) condition.',
			'alias' => 'prewet',
			'unit_of_measure' => 'm2',
			'rate' => 1400,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //34
			'name' => 'T1 Slurry',
			'description' => 'Apply Kryton’s Krystol T1 <sup>&reg;</sup> waterproofing compound to surface in a slurry form in accordance with manufacturer’s specification.',
			'alias' => 't1slurry',
			'unit_of_measure' => 'm2',
			'rate' => 480,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //35
			'name' => 'Moist Cure',
			'description' => 'Moist cure all treated areas as per Krytons specification in order to insure perfect curing and allow for the Krystols to grow and develop its full properties.',
			'alias' => 'moistcure',
			'unit_of_measure' => 'm2',
			'rate' => 1400,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //36
			'name' => 'T2 Slurry',
			'description' => 'Apply Kryton’s Krystol T2<sup>&reg;</sup\> waterproofing compound to surface in a slurry form in accordance with manufacturer’s specification.',
			'alias' => 't2slurry',
			'unit_of_measure' => 'm2',
			'rate' => 480,
			'created_at' => Carbon::now()
		]);

		//Plaster KMA
		DB::table('tasks')->insert([ //37
			'name' => 'Chip Plaster',
			'description' => 'Remove existing damaged plaster using electric chisels.',
			'alias' => 'chipplaster',
			'unit_of_measure' => 'm2',
			'rate' => 60,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //38
			'name' => 'Plaster with KMA',
			'description' => 'Re-plaster exposed bricks using a Krystol Mortar Waterproof Admixture render.',
			'alias' => 'kmaplaster',
			'unit_of_measure' => 'm2',
			'rate' => 60,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //39
			'name' => 'Alkali Primer',
			'description' => 'Coat all newly plastered areas with an alkali resistant plaster.',
			'alias' => 'alkaliprime',
			'unit_of_measure' => 'm2',
			'rate' => 500,
			'created_at' => Carbon::now()
		]);
		
		DB::table('tasks')->insert([ //40
			'name' => 'Undercoat',
			'description' => 'Coat newly stripped paint coatings with an industrial grade undercoat.',
			'alias' => 'undercoat',
			'unit_of_measure' => 'm2',
			'rate' => 400,
			'created_at' => Carbon::now()
		]);
		DB::table('tasks')->insert([ //41
			'name' => 'Coating',
			'description' => 'Coat all newly primed and undercoated areas using industrial grade paint',
			'alias' => 'paintwall',
			'unit_of_measure' => 'm2',
			'rate' => 300,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //42
			'name' => 'Overlaps',
			'description' => 'Waterproof overlaps to manufacturers specification using non-woven polyester waterproofing membrane impregnated with 100 % pure acrylic waterproofing compound.',
			'alias' => 'klip-lokoverlaps',
			'unit_of_measure' => 'm2',
			'link_to' => 'area',
			'rate' => 125,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //43
			'name' => 'Silvakote',
			'description' => 'Apply 2 coats of Bitumastic Aluminium coating to the torched area',
			'alias' => 'silvakote',
			'unit_of_measure' => 'm2',
			'link_to' => 'area',
			'rate' => 600,
			'created_at' => Carbon::now()
		]);

		DB::table('tasks')->insert([ //44
			'name' => 'Rubberised',
			'description' => 'Apply 2 coats of Rubberised Bitumin to the prepeared area and allow specified curing time',
			'alias' => 'rubberised',
			'unit_of_measure' => 'm2',
			'link_to' => 'area',
			'rate' => 40,
			'created_at' => Carbon::now()
		]);
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
