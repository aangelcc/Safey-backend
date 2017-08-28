<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => 'Best product '.$faker->unique()->numberBetween(1,2000),
                'description' => $faker->realText(100),
                'price' => $faker->numberBetween(3,999),
                'images' => 'test.png, test1.png',
                'stock' => $faker->numberBetween(0,90),
                'rating' => $faker->numberBetween(0,5),
                'store_id' => $faker->numberBetween(1,9),
            ]);
        }
    }
}
