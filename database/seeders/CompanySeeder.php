<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Liberty',
            'address1' => '1 Ameshoff Street',
            'address2' => 'Braamfontein',
            'address3' => 'Johannesburg',
            'post_code' => 0,
            'vat' => 123456789,
            'created_at' => Carbon::now(),
        ]);
        DB::table('companies')->insert([
            'name' => 'Private',
            'address1' => '',
            'address2' => '',
            'address3' => '',
            'post_code' => 0,
            'vat' => 123456789,
            'created_at' => Carbon::now(),
        ]);
    }
}
