<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		DB::table('employees')->insert([
			'name'=>'Colte Smit',
			'skill_id' => 5,
			'day_rate' => 400.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0829285788',
			'id_num' => '9311105179081',
			'image' => '',
			'nok_name'=> 'Tanika McCOlgan',
			'nok_number' => '0837934504',
			'fp_id' => 25,
			'card_id' => NULL,
			'payroll' => 3095,
			'clocked' => 1,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Juan Pienaar',
			'skill_id' => 5,
			'day_rate' => 400.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 18,
			'card_id' => NULL,
			'payroll' => 3121,
			'clocked' => 1,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Floyd Sibeko',
			'skill_id' => 4,
			'day_rate' => 165.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0711628965',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'Pretty',
			'nok_number' => '0767375024',
			'fp_id' => 13,
			'card_id' => NULL,
			'payroll' => 3024,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Laurence Ngwenya',
			'skill_id' =>  2,
			'day_rate' =>  190.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 21,
			'card_id' => NULL,
			'payroll' => 3011,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Manuel Muchanga',
			'skill_id' => 3,
			'day_rate' => 191.91,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0789891791',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 23,
			'card_id' => NULL,
			'payroll' => 3083,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Jabu Moabona',
			'skill_id' => 3,
			'day_rate' => 175.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 16,
			'card_id' => NULL,
			'payroll' => 3120,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'James Khoza',
			'skill_id' => 2,
			'day_rate' => 190.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0714071767',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'Jack Mudupi',
			'nok_number' => '0738941431',
			'fp_id' => 17,
			'card_id' => NULL,
			'payroll' => 3091,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Thys Kruger',
			'skill_id' => 5,
			'day_rate' => 404.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0717099260',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 30,
			'card_id' => NULL,
			'payroll' => 3094,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Jim Mabena',
			'skill_id' => 6,
			'day_rate' => 185.40,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0714071767',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'Jack Mudupi',
			'nok_number' => '0738941431',
			'fp_id' => 19,
			'card_id' => NULL,
			'payroll' => 3089,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Joseph Khoza',
			'skill_id' => 2,
			'day_rate' => 237.50,
			'employed_date' => '2016-04-22 12:33',
			'active' => 0,
			'cell' => '0788180868',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'Mavis Nakhauhambe',
			'nok_number' => '0844951492',
			'fp_id' => 20,
			'card_id' => NULL,
			'payroll' => 3061,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Welcome Mdhluli',
			'skill_id' => 2,
			'day_rate' => 270.93,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0711885640',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 31,
			'card_id' => NULL,
			'payroll' => 3019,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Solly Ndlovu',
			'skill_id' => 7,
			'day_rate' => 175.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'Nomvula', 
			'nok_number' => '0783835178',
			'fp_id' => 28,
			'card_id' => '6BAAF004',
			'payroll' =>  3073,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Zito Mabunda',
			'skill_id' => 4,
			'day_rate' => 175.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0786374284',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 32,
			'card_id' => NULL,
			'payroll' => 3118,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Oscar Banda',
			'skill_id' => 4,
			'day_rate' => 165.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 24,
			'card_id' => NULL,
			'payroll' => 3127,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Anthony Mngxali',
			'skill_id' => 4,
			'day_rate' => 190.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0735813215',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 10,
			'card_id' => NULL,
			'payroll' => 3001,
			'clocked' => 1,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Jabu Mgagadeli',
			'skill_id' => 4,
			'day_rate' => 186.26,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0820452778',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na', 
			'nok_number' => 'na',
			'fp_id' => 15,
			'card_id' => '9BF1F204',
			'payroll' =>  3008,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Lawrence Mmatladi',
			'skill_id' =>  4,
			'day_rate' =>  165.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 22,
			'card_id' => NULL,
			'payroll' => 3084,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Richard Hlongwane',
			'skill_id' => 4,
			'day_rate' => 180.62,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0723284435',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na', 
			'nok_number' => 'na',
			'fp_id' => 27,
			'card_id' => '1B69EF04',
			'payroll' =>  3002,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Solomon Mathonsi',
			'skill_id' => 4,
			'day_rate' => 169.95,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na', 
			'nok_number' => 'na',
			'fp_id' => 29,
			'card_id' => 'DB60E504',
			'payroll' =>  3017,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'December Mavuso',
			'skill_id' =>  2,
			'day_rate' =>  197.92,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0123456789',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 33,
			'card_id' => NULL,
			'payroll' => 3128,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Cedric Thseko Marobela',
			'skill_id' => 7,
			'day_rate' =>  170.00, 
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '1',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 11,
			'card_id' => NULL,
			'payroll' => 3100,
			'clocked' => 0,
			'lastscan' =>  Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Isaac ',
			'skill_id' => 3,
			'day_rate' => 180.00, 
			'employed_date' => '2016-04-22 12:33',
			'active' => 0,
			'cell' => '01234',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 14,
			'card_id' => NULL,
			'payroll' => 0,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Roark McColgan',
			'skill_id' => 5,
			'day_rate' => 150.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0712871097',
			'id_num' => '2147483647',
			'image' => '',
			'nok_name'=> 'Tanika McColgan', 
			'nok_number' => '0837934504',
			'fp_id' => 1,
			'card_id' => '5BC6E604',
			'payroll' =>  3105,
			'clocked' => 1,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Danie Mokhatla',
			'skill_id' => 2,
			'day_rate' => 197.92,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '01234',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 12,
			'card_id' => NULL,
			'payroll' => 3090,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Peter Sibisi',
			'skill_id' => 7,
			'day_rate' => 165.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 0,
			'cell' => '01234',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'na',
			'nok_number' => 'na',
			'fp_id' => 26,
			'card_id' => NULL,
			'payroll' => 3119,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Morgan Sibisi',
			'skill_id' => 2,
			'day_rate' => 200.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0769986280',
			'id_num' => '7102106030080',
			'image' => '',
			'nok_name'=> 'Patricia',
			'nok_number' => '0799631737',
			'fp_id' => 37,
			'card_id' => NULL,
			'payroll' => 3132,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Billiat Chumachiyenda',
			'skill_id' => 1,
			'day_rate' => 150.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0734158300',
			'id_num' => '0',
			'image' => '',
			'nok_name'=> 'Maria',
			'nok_number' => '0732004832',
			'fp_id' => 38,
			'card_id' => NULL,
			'payroll' => 3125,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Alphas Khoza',
			'skill_id' => 2,
			'day_rate' => 190.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0840399677',
			'id_num' => '7902065655086',
			'image' => '',
			'nok_name'=> 'Joseph Khoza',
			'nok_number' => '0',
			'fp_id' => 40,
			'card_id' => NULL,
			'payroll' => 3130,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Crosby Sithole',
			'skill_id' => 1,
			'day_rate' => 150.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0123456789',
			'id_num' => '123456789012',
			'image' => '',
			'nok_name'=> 'Tom Petty',
			'nok_number' => '0123456789',
			'fp_id' => 41,
			'card_id' => '',
			'payroll' => 3135,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);

		DB::table('employees')->insert([
			'name'=>'Andries Mahlangu',
			'skill_id' => 4,
			'day_rate' => 150.00,
			'employed_date' => '2016-04-22 12:33',
			'active' => 1,
			'cell' => '0123456789',
			'id_num' => '123456789012',
			'image' => '',
			'nok_name'=> 'Tom Petty',
			'nok_number' => '0123456789',
			'fp_id' => 42,
			'card_id' => '',
			'payroll' => 3136,
			'clocked' => 0,
			'lastscan' => Carbon::now()->subDay(),
			'created_at' => Carbon::now()
		]);
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}
