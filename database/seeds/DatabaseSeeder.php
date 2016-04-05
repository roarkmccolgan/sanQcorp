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
        //$this->call(UsersTableSeeder::class);
        $this->call(JobsSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(ContactsJobsSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(SystemSeeder::class);
        $this->call(SystemMaterialsSeeder::class);

        Model::reguard();
    }
}
