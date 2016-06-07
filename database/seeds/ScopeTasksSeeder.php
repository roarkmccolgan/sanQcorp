<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScopeTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //Establish safe...
        DB::table('scope_task')->insert([
            'scope_id' => 1,
            'task_id' => 1,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 1,
            'task_id' => 2,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 1,
            'task_id' => 3,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 1,
            'task_id' => 4,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 1,
            'task_id' => 5,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 1,
            'task_id' => 6,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 1,
            'task_id' => 7,
        ]);

        //Clean and De-establish...
        DB::table('scope_task')->insert([
            'scope_id' => 11,
            'task_id' => 1,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 11,
            'task_id' => 2,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 11,
            'task_id' => 3,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 11,
            'task_id' => 4,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 11,
            'task_id' => 5,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 11,
            'task_id' => 6,
        ]);
        DB::table('scope_task')->insert([
            'scope_id' => 11,
            'task_id' => 7,
        ]);

        //stripping
        DB::table('scope_task')->insert([
            'scope_id' => 2,
            'task_id' => 3,
        ]);

        //fillets
        DB::table('scope_task')->insert([
            'scope_id' => 3,
            'task_id' => 4,
        ]);

        //sanika boards
        DB::table('scope_task')->insert([
            'scope_id' => 4,
            'task_id' => 4,
        ]);

        //wooden boards
        DB::table('scope_task')->insert([
            'scope_id' => 5,
            'task_id' => 5,
        ]);

        //screed repair
        DB::table('scope_task')->insert([
            'scope_id' => 6,
            'task_id' => 7,
        ]);

        //prime
        DB::table('scope_task')->insert([
            'scope_id' => 7,
            'task_id' => 6,
        ]);

        //mineral torchon
        DB::table('scope_task')->insert([
            'scope_id' => 8,
            'task_id' => 1,
        ]);

        //plain torchon
        DB::table('scope_task')->insert([
            'scope_id' => 9,
            'task_id' => 8,
        ]);

        //Acrylic
        DB::table('scope_task')->insert([
            'scope_id' => 10,
            'task_id' => 2,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
