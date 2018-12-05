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
        // \DB::table('users')->insert([
        //     'name'      => 'joao',
        //     'email'     => 'joao@treinaweb.com.br',
        //     'password'  => bcrypt('1234')
        // ]);

        \App\User::create([
            'name'      => 'joao123',
            'email'     => 'joao123@treinaweb.com.br',
            'password'  => bcrypt('1234')
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
