<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UserSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ContactJobSeeder::class);

        $this->call(SkillSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(FuelSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(GuaranteesSeeder::class);
        $this->call(SystemSeeder::class);
        //$this->call(ScopeSeeder::class);
        $this->call(TasksSeeder::class);
        $this->call(SystemTaskSeeder::class);
        $this->call(PhotoSeeder::class);
        //$this->call(ScopeSystemSeeder::class);
        $this->call(TaskMaterialsSeeder::class);
        $this->call(VariableSeeder::class);
        $this->call(TaskVariableSeeder::class);

        $this->call(TaskPropertySeeder::class);

        $this->call(PandgCategoriesSeeder::class);

        $this->call(termTableSeeder::class);
        $this->call(SystemTermSeeder::class);
        $this->call(LabourSeeder::class);
        $this->call(LabourSystemSeeder::class);
        $this->call(JobIncludeSeeder::class);
        $this->call(SurveySeeder::class);

        Model::reguard();
    }
}
