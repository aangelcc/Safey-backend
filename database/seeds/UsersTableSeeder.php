<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Importar faker
        $faker = Faker\Factory::create();

        for($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'personal_id' => $faker->unique()->isbn13,
                'name' => $faker->name,
                'surname' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => bcrypt($faker->password()),
                'birthday' => $faker->date(),
                'gender' => 'M',
                'role' => '1'
            ]);
        }
    }
}
