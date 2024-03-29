<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
        $this->call(UsersTableSeeder::class);
        $this->call(JobsSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(ContactsJobsSeeder::class);

        $this->call(SkillSeeder::class);
        $this->call(EmployeesSeeder::class);
        $this->call(FuelSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(GuaranteesSeeder::class);
        $this->call(SystemSeeder::class);
        //$this->call(ScopeSeeder::class);
        $this->call(TasksSeeder::class);
        $this->call(SystemTaskSeeder::class);
        $this->call(PhotosSeeder::class);
        //$this->call(ScopeSystemSeeder::class);
        $this->call(TaskMaterialsSeeder::class);
        $this->call(TaskVariableSeeder::class); 
        $this->call(TaskPropertySeeder::class);
        
        $this->call(PandGCategorySeeder::class);
        
        $this->call(termTableSeeder::class);
        $this->call(SystemTermSeeder::class);
        $this->call(labourSeeder::class);
        $this->call(LabourSystemSeeder::class);
        $this->call(JobIncludesSeeder::class);
        $this->call(SurveySeeder::class);

        Model::reguard();
    }
}
