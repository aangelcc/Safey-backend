<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
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
            DB::table('orders')->insert([
                'user_id' => $faker->numberBetween(1,9),
                'url' => $faker->url,
                'product_id' => $faker->numberBetween(1,9),
                'status' => $faker->numberBetween(1,3),
                'observation' => $faker->realText(150),
            ]);
        }
    }
}
