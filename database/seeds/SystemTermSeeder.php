<?php

use Illuminate\Database\Seeder;

class SystemTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //concrete
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 1,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 2,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 3,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 4,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 5,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 6,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 7,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 8,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 9,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 1,
            'term_id' => 10,
        ]);

        //boarded
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 1,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 2,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 3,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 4,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 5,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 6,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 7,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 8,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 9,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 2,
            'term_id' => 10,
        ]);

        //Poly Boarded
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 1,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 2,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 3,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 4,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 5,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 6,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 7,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 8,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 9,
        ]);
        DB::table('system_term')->insert([
            'system_id' => 3,
            'term_id' => 10,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
