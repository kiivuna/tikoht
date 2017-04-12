<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * https://laravel.com/docs/5.4/seeding
     * php artisan db:seed --class=UsersTableSeeder
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@example.com',
            'password' => bcrypt('secret'),
        ]);
    }
}