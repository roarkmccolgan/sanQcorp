<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('system')->insert([ //1
			'name' => 'Concrete Roof Maintenance-Free Torch-on',
			'description' => 'This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
			'alias' => 'Mineral Maintenance-Free Torch-on System',
			'unit' => 'm2',
			'base_rate' => 250.00,
			'created_at' => Carbon::now()
		]);
		DB::table('system')->insert([ //2
			'name' => 'Sanika IBR Boarded Maintenance-Free Torch-on',
			'description' => 'Our insulative boarded system is awesome. This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
			'alias' => 'Sanika\'s insulative Boarded System',
			'unit' => 'm2',
			'base_rate' => 450.00,
			'created_at' => Carbon::now()
		]);
		DB::table('system')->insert([ //3
			'name' => 'Sanika\'s Thermo Regulating and Sound Proofing Insulative Boarded Waterproofing System - Concrete Roof',
			'description' => '
				<p>
					Sanika have developed a roof cladding system that is comprised of industrial grade high density polystyrene boards blended with industrial grade polyurethane adhered together under high pressure to a flame retardant fibre cement board and laser cut fire retardant fillers to suit sheeting profile if
				</p>
				<p>
					<strong>This system will eliminate any water penetration and external thermal radiation by application of a laminated insulative panel, profiled to the sheet design and topped with a maintenance free torch on membrane which renders the roof area totally waterproof. The Sanika insulative boarded waterproofing system eliminates the hail and rain noise on the roof sheeting and the insulative properties result in thermo stabilization during the cold Winters and harsh Summer months.</strong>
				</p>
				<p>
					This system has successfully been utilized over the last 20 years and has been installed in many areas including Mnet Supersport, Outside Broadcast, Growthpoint Properties, Spar Group, JHI Properties, Liberty Properties – Sandton City SA Breweries and Impala Platinum Refineries and has seen vast reduction of thermal energy within these areas and is a completely sealed and corrosion free roofing system
				</p>
				<p>
					The system is guaranteed for a period of ten years maintenance free.
				</p>
			',
			'alias' => 'Sanika\'s Thermo Regulating Boarded System',
			'unit' => 'm2',
			'base_rate' => 550.00,
			'created_at' => Carbon::now()
		]);

		DB::table('system')->insert([ //4
			'name' => 'Sanika IBR Full-spec Waterproofing and Coating',
			'description' => '
				<p>
					The Full-spec waterproofing and coating system is a cost-effective way to ensure your roof is free of water leaks, corrosion and deteriation for a medium to long period of time.<br/>
					Sanika only uses the highest quality waterproofing and coating products. You, the client will have an option from our standard range of colours.
				</p>
				<p>
					The system carries a 6-year guarantee on the roof coating and a 3-year guarantee on the waterproofing flashing details.
				</p>
			',
			'alias' => 'IBR Full-spec',
			'unit' => 'm2',
			'base_rate' => 180.00,
			'created_at' => Carbon::now()
		]);
	}
}
