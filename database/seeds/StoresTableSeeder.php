<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
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
            DB::table('stores')->insert([
                'name' => $faker->firstName."'s",
                'description' => $faker->realText(100),
                'address' => $faker->streetAddress,
                'rating' => $faker->numberBetween(0,5),
                'image' => 'test.png',
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'cif' => $faker->unique()->isbn13,
                'owner_id' => $faker->numberBetween(1,9),
            ]);
        }
    }
}
