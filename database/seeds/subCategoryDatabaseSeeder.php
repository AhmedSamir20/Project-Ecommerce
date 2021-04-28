<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class subCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Category::class, 20)->create([
            'parent_id'=>$this->getRandomParentId()
        ]);
    }

    private function getRandomParentId()
    {
       $parent_id = Category::inRandomOrder()->first();
        return $parent_id;
    }
}
