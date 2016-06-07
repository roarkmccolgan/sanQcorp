<?php

use Illuminate\Database\Seeder;

class SystemTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //Concrete...
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 9, //establish
            'order' => 1
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 3, //stripping
            'order' => 2
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 7, //screed
            'order' => 3
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 6, //prime
            'order' => 4
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 1, //mineral
            'order' => 5
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 8, //plain
            'order' => 6
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 2, //acrylic
            'order' => 7
        ]);
        DB::table('system_task')->insert([
            'system_id' => 1,
            'task_id' => 10, //clean de-establish
            'order' => 8
        ]);

        //boarded...
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 9, //establish
            'order' => 1
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 11, //fillets
            'order' => 2
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 4, //sanika boards
            'order' => 3
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 5, //wooden boards
            'order' => 4
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 6, //prime
            'order' => 5
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 1, //mineral
            'order' => 6
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 8, //plain
            'order' => 7
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 2, //acrylic
            'order' => 8
        ]);
        DB::table('system_task')->insert([
            'system_id' => 2,
            'task_id' => 10, //clean de-establish
            'order' => 9
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
