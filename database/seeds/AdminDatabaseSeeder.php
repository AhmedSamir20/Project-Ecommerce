<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::Create([
                'name'=>'Ahmed samir',
                'email'=>'admin@gmail',
                'password'=>bcrypt('admin@gmail')
        ]);
    }
}
