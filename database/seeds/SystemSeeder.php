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
    public function run()
    {
        //Waterproofing
		DB::table('systems')->insert([ //1
			'name' => 'Waterproofing and Coating of an IBR Roof',
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
			'group' => 'Waterproofing',
			'base_rate' => 180.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 3,
		]);

		DB::table('systems')->insert([ //2
			'name' => 'Waterproofing and Coating of a Klip-Lok Roof',
			'description' => '
				<p>
					The Full-spec waterproofing and coating system is a cost-effective way to ensure your roof is free of water leaks, corrosion and deteriation for a medium to long period of time.<br/>
					Sanika only uses the highest quality waterproofing and coating products. You, the client will have an option from our standard range of colours.
				</p>
				<p>
					The system carries a 6-year guarantee on the roof coating and a 3-year guarantee on the waterproofing flashing details.
				</p>
			',
			'alias' => 'Tile Roof Full-spec',
			'unit' => 'm2',
			'group' => 'Waterproofing',
			'base_rate' => 180.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 3,
		]);

		DB::table('systems')->insert([ //3
			'name' => 'Waterproofing and Coating of a Tile Roof',
			'description' => '
				<p>
					The Full-spec waterproofing and coating system is a cost-effective way to ensure your roof is free of water leaks and deteriation for a medium to long period of time.<br/>
					Sanika only uses the highest quality waterproofing and coating products. You, the client will have an option from our standard range of colours.
				</p>
				<p>
					The system carries a 6-year guarantee on the roof coating and a 3-year guarantee on the waterproofing flashing details.
				</p>
			',
			'alias' => 'Tile Roof Full-spec',
			'unit' => 'm2',
			'group' => 'Waterproofing',
			'base_rate' => 180.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 3,
		]);

		DB::table('systems')->insert([ //4
			'name' => 'Waterproofing and Coating of a Corrugated Roof',
			'description' => '
				<p>
					The Full-spec waterproofing and coating system is a cost-effective way to ensure your roof is free of water leaks and deteriation for a medium to long period of time.<br/>
					Sanika only uses the highest quality waterproofing and coating products. You, the client will have an option from our standard range of colours.
				</p>
				<p>
					The system carries a 6-year guarantee on the roof coating and a 3-year guarantee on the waterproofing flashing details.
				</p>
			',
			'alias' => 'Corrugated Full-spec',
			'unit' => 'm2',
			'group' => 'Waterproofing',
			'base_rate' => 180.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 3,
		]);

		//Torch-on
		DB::table('systems')->insert([ //5
			'name' => 'Sanika\'s Maintenance Free Mineral Torch-on Waterproofing System',
			'description' => 'This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
			'alias' => 'Mineral Maintenance-Free Torch-on System',
			'unit' => 'm2',
			'group' => 'Torch-on',
			'base_rate' => 250.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //6
			'name' => 'Sanika\'s Heat-bonded, Plain Finish Torch-on Waterproofing System',
			'description' => 'This heat bonded system ensures a water tight seal over the once bonded, the surface will be coatied with 2 coats of bitumastic aluminium coating. Maintenance coating will need to be carried out every 24-26 months.',
			'alias' => 'Plain Torch-on System',
			'unit' => 'm2',
			'group' => 'Torch-on',
			'base_rate' => 210.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //7
			'name' => 'Sanika\'s Heat-bonded, Dual-Layer Torch-on Waterproofing System',
			'description' => 'This heat bonded dual-layered system ensures a water tight seal over the once bonded, the surface will be coatied with 2 coats of bitumastic aluminium coating. Maintenance coating will need to be carried out every 24-26 months.',
			'alias' => 'Plain Dual Layer Torch-on System',
			'unit' => 'm2',
			'group' => 'Torch-on',
			'base_rate' => 350.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //8
			'name' => 'Sanika\'s Heat-bonded, Fibre-Reinforced Torch-on Waterproofing System',
			'description' => 'This heat bonded Fibre-Reinforced system ensures a water tight seal over the once bonded, the surface will be coatied with 2 coats of bitumastic aluminium coating. Maintenance coating will need to be carried out every 24-26 months.',
			'alias' => 'Plain Fibre-reinforced Torch-on System',
			'unit' => 'm2',
			'group' => 'Torch-on',
			'base_rate' => 350.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		//Insulative boarded

		DB::table('systems')->insert([ //9
			'name' => 'Sanika\'s Insulative Boarded Waterproofing System on a Concrete Roof',
			'description' => 'Our insulative boarded system is awesome. This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
			'alias' => 'Sanika\'s insulative Boarded System',
			'unit' => 'm2',
			'group' => 'Insulative boarded',
			'base_rate' => 450.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //10
			'name' => 'Sanika’s Insulative Boarded Waterproofing System on a IBR Roof',
			'description' => 'Our insulative boarded system is awesome. This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
			'alias' => 'Sanika\'s insulative Boarded System',
			'unit' => 'm2',
			'group' => 'Insulative boarded',
			'base_rate' => 450.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //11
			'name' => 'Sanika\'s Insulative Boarded Waterproofing System on a Corrugated Roof',
			'description' => 'Our insulative boarded system is awesome. This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
			'alias' => 'Sanika\'s insulative Boarded System',
			'unit' => 'm2',
			'group' => 'Insulative boarded',
			'base_rate' => 450.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //12
			'name' => 'Sanika\'s Insulative Boarded Waterproofing System on a Klip-Lok Roof',
			'description' => 'Our insulative boarded system is awesome. This heat bonded system has a mineral stone chip finish that is both aesthetically pleasing and comes with a 10 year, Maintenance-Free guarantee,',
			'alias' => 'Sanika\'s insulative Boarded System',
			'unit' => 'm2',
			'group' => 'Insulative boarded',
			'base_rate' => 450.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //13
			'name' => 'Sanika\'s Thermo Regulating and Sound Proofing Insulative Boarded Waterproofing System on a Concrete Roof',
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
			'group' => 'Thermo Regulating and Soundproofing ',
			'base_rate' => 550.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //14
			'name' => 'Sanika’s Thermo Regulating and Soundproofing Insulative Boarded Waterproofing System on a IBR Roof',
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
			'group' => 'Thermo Regulating and Soundproofing ',
			'base_rate' => 550.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 1,
		]);

		DB::table('systems')->insert([ //15
			'name' => 'Kryton Concrete Repair, Waterproofing and Rejuvination',
			'description' => '
				<p>
					Kryton’s concrete repair products are specially designed to resurface, waterproof and repair leaking cracks, penetrations, tie-holes and defective concrete from the positive or negative side of the water pressure. The product line includes Krystol Plug, Krystol Repair Grout and Krystol T1, which can be used together to form the Krystol Leak Repair System, and Krystol Bari-Cote.
				</p>
				<p>
					Kryton Concrete Repair products are 100% compatible with the entire line of Krystol products. They can be used in concrete that was built yesterday, or structures needing waterproofing repair after decades of service.
				</p>
			',
			'alias' => 'Kryton Concrete Repair, Waterproofing and Rejuvination',
			'unit' => 'm2',
			'group' => 'Kryton',
			'base_rate' => 550.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 2,
		]);

		DB::table('systems')->insert([ //16
			'name' => 'Kryton Krystol Plaster Waterproofing System',
			'description' => '
				<p>
					Krystol Mortar Admixture (KMA) is a hydrophilic crystalline admixture used to provide long-term protection of masonry mortars and concrete masonry units against water and waterborne contaminants by reducing permeability and absorption of the mortar.
				</p>
				<p>
					KMA simplifies installation by removing the need for surface applied sealers and is easily incorporated into the existing mix-design and application processes. KMA provides superior waterproofing performance that lowers building maintenance and repair costs.
				</p>
			',
			'alias' => 'Kryton KMA',
			'unit' => 'm2',
			'group' => 'Kryton',
			'base_rate' => 550.00,
			'created_at' => Carbon::now(),
			'guarantee_id' => 4,
		]);

		DB::table('systems')->insert([ //17
			'name' => 'Custom - Specialised Sanika System',
			'description' => 'Describe type of work',
			'alias' => 'Custom System',
			'unit' => 'm2',
			'group' => 'Custom',
			'base_rate' => 0.00,
			'created_at' => Carbon::now()
		]);
    }
}
