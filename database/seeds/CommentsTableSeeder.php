<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
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
            DB::table('comments')->insert([
                'comment' => $faker->realText(150),
                'user_id' => $faker->numberBetween(1,9),
                'product_rating' => $faker->numberBetween(0,5),
                'comment_rating' => $faker->numberBetween(0,1000),
                'product_id' => $faker->numberBetween(1,9),
            ]);
        }
    }
}
