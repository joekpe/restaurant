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
        DB::table('users')->insert([
            'name' => 'Joshua Kperator',
            'email' => 'jkperator@gmail.com',
            'password' => bcrypt('password'),
            'access_level' => 'super',
            'institution_id' => '0',
        ]);
    }
}
