<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            'name' => 'Liberty',
            'address1' => '1 Ameshoff Street',
            'address2' => 'Braamfontein',
            'address3' => 'Johannesburg',
            'post_code' => 0,
            'vat' => 123456789,
            'created_at' => Carbon::now()
        ]);
        DB::table('company')->insert([
            'name' => 'Private',
            'address1' => '',
            'address2' => '',
            'address3' => '',
            'post_code' => 0,
            'vat' => 123456789,
            'created_at' => Carbon::now()
        ]);
    }
}
