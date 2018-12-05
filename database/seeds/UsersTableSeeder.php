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
        \App\User::create([
            'name'      => str_random(10),
            'email'     => str_random(15) . '@treinaweb.com.br',
            'password'  => bcrypt('1234')
        ]);
    }
}
