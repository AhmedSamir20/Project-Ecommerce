<?php

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
        // $this->call(UserSeeder::class);
        $this->call(AdminDatabaseSeeder::class);
         $this->call(SettingDataBaseSeeder::class);
         $this->call(CategoryDatabaseSeeder::class);
         $this->call(subCategoryDatabaseSeeder::class);
         $this->call(ProductDatabaseSeeder::class);

    }
}
