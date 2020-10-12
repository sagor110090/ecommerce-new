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
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(ThemeSeeder::class);

        //

        DB::table('paypal_info')->insert([
            'client_id' => '',
            'client_secret' => '',
            'currency' => '',
        ]);
        DB::table('contact_us')->insert([
            'content' => '',
        ]);
        DB::table('setting')->insert([
            'site_name' => ' ',
        ]);
        DB::table('terms_and_conditions')->insert(['terms_and_condition' => 'text']);
    }
}