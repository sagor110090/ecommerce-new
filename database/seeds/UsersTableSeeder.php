<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'fname' => 'Mehedi Hasan',
            'lname' => 'Sagor',
            'email' => 'developer@merinasoft.com',
            'role' => 'Super Admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
