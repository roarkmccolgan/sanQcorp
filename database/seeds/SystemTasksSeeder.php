<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SystemTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //Concrete
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 1,
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 2,
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 3,
        ]);

        //Boarded
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 1,
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 2,
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 3,
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 4,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
