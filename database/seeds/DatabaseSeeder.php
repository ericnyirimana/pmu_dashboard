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

      
        $this->call(UsersTableSeeder::class);
        $this->call(OperatorTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(RestaurantsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuSectionsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PickUpsTableSeeder::class);
        $this->call(ShowcasesTableSeeder::class);

    }
}
