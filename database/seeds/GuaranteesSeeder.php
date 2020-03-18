<?php

use Illuminate\Database\Seeder;

class GuaranteesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guarantees')->insert([ // torch-on
            'description' => '<p>The above scope of work is guaranteed for a period of TEN years (to the torch on membrane) with minor maintenance to flashing details at client\'s expense (every 30-36 months).</p>',
            'years' => 10,
            'maintenance' => 30,
        ]);

        DB::table('guarantees')->insert([ // kryton product
            'description' => '
            	<strong>Kryton Warranty:</strong><br/>
				<p>Kryton offers the best-in-industry warranty that guarantees Krystol-treated areas of your
				structure will remain watertight during the warranty period. Our standard warranties
				include a 10-year warranty for our surface applied products.</p>
				<p>All Kryton products are covered by our standard warranty, which guarantees every product
				is free from defects of manufacture. Please note that the above warranty is based on
				correct dosages and application methods being utilized.</p>
				<p>This Warranty only covers cracks that are humanly visible and detectable at the time of
				application and does not cover any new cracks forming after completion or any Structural
				Deterioration.</p>
				<strong>Sanika Warranty:</strong>
				<p>Sanika offers a 12-month workmanship guarantee that all work performed is carried out to
				the exact Kryton supplied specification in order to validate the attached Kryton guarantee.</p>
            ',
            'years' => 10,
            'maintenance' => 0,
        ]);

        DB::table('guarantees')->insert([ // Coatings
            'description' => '<p>The above scope of work is guaranteed for a period of 5 years (on the roof coating) with minor maintenance to flashing details at client\'s expense (every 30-36 months).</p>',
            'years' => 5,
            'maintenance' => 30,
        ]);

        DB::table('guarantees')->insert([ // Kryton KMA
            'description' => '<p>The Kryton KMA carries a standard 5-year product warranty</p>',
            'years' => 5,
            'maintenance' => 0,
        ]);

        DB::table('guarantees')->insert([ // Kryton KMA
            'description' => '<p>Waterproofing of gutter system is guaranteed for a period of ten years with maintenance to the entire system every 36 months at
clients’ expense.</p>',
            'years' => 10,
            'maintenance' => 30,
        ]);
    }
}
