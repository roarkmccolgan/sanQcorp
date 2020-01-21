<?php

use Illuminate\Database\Seeder;

class TaskVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_variables')->insert([ //1
        	'task_id' => 3,
            'name' => 'Material Type',
            'label' => 'Lose-lay',
            'rate' => 1000
        ]);
        DB::table('task_variables')->insert([ //1
        	'task_id' => 3,
            'name' => 'Material Type',
            'label' => 'Single Layer',
            'rate' => 100
        ]);
        DB::table('task_variables')->insert([ //1
        	'task_id' => 3,
            'name' => 'Material Type',
            'label' => 'Double Layer',
            'rate' => 50
        ]);
        DB::table('task_variables')->insert([ //1
        	'task_id' => 3,
            'name' => 'Material Type',
            'label' => 'Hot-pour',
            'rate' => 10
        ]);
    }
}
