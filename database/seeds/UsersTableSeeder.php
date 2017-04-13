<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
 
use Faker\Factory as Faker;
 
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * http://laraveldaily.com/generating-fake-seeds-data-with-faker-package/
     * php artisan db:seed --class=UsersTableSeeder
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,3) as $index) {   /* Luo nyt kolme kpletta käyttäjiä kerralla */
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
