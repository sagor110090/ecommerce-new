<?php

use Illuminate\Database\Seeder;
class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theme')->truncate();
        DB::table('theme')->insert([
            'name' =>  'select_layout',
            'select_layout' =>  'dark dark-sidebar theme-black',
            'sidebar_color' =>  'dark-sidebar',
            'color_theme' =>  'theme-black',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'sidebar',
            'select_layout' =>  '',
            'sidebar_color' =>  'dark-sidebar',
            'color_theme' =>  '',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'theme',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'theme-cyan',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'theme',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'theme-black',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'theme',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'theme-purple',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'theme',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'theme-orange',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'theme',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'theme-green',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'theme',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'theme-green',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'mini_sidebar',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'sidebar-mini',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
        DB::table('theme')->insert([
            'name' =>  'sticky_heade',
            'select_layout' =>  '',
            'sidebar_color' =>  '',
            'color_theme' =>  'sticky',
            'mini_sidebar' =>  '',
            'sticky_header' =>  '',
        ]);
    }
}
