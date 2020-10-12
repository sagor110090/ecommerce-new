<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {DB::table('permissions')->truncate();

        DB::table('permissions')->insert(['name' => 'category-show']);
        DB::table('permissions')->insert(['name' => 'category-create']);
        DB::table('permissions')->insert(['name' => 'category-edit']);
        DB::table('permissions')->insert(['name' => 'category-delete']);
        DB::table('permissions')->insert(['name' => 'subcategory-show']);
        DB::table('permissions')->insert(['name' => 'subcategory-create']);
        DB::table('permissions')->insert(['name' => 'subcategory-edit']);
        DB::table('permissions')->insert(['name' => 'subcategory-delete']);
        DB::table('permissions')->insert(['name' => 'minicategory-show']);
        DB::table('permissions')->insert(['name' => 'minicategory-create']);
        DB::table('permissions')->insert(['name' => 'minicategory-edit']);
        DB::table('permissions')->insert(['name' => 'minicategory-delete']);
        DB::table('permissions')->insert(['name' => 'type-show']);
        DB::table('permissions')->insert(['name' => 'type-create']);
        DB::table('permissions')->insert(['name' => 'type-edit']);
        DB::table('permissions')->insert(['name' => 'type-delete']);
        DB::table('permissions')->insert(['name' => 'brand-show']);
        DB::table('permissions')->insert(['name' => 'brand-create']);
        DB::table('permissions')->insert(['name' => 'brand-edit']);
        DB::table('permissions')->insert(['name' => 'brand-delete']);
        DB::table('permissions')->insert(['name' => 'size-show']);
        DB::table('permissions')->insert(['name' => 'size-create']);
        DB::table('permissions')->insert(['name' => 'size-edit']);
        DB::table('permissions')->insert(['name' => 'size-delete']);
        DB::table('permissions')->insert(['name' => 'color-show']);
        DB::table('permissions')->insert(['name' => 'color-create']);
        DB::table('permissions')->insert(['name' => 'color-edit']);
        DB::table('permissions')->insert(['name' => 'color-delete']);
        DB::table('permissions')->insert(['name' => 'supplier-show']);
        DB::table('permissions')->insert(['name' => 'supplier-create']);
        DB::table('permissions')->insert(['name' => 'supplier-edit']);
        DB::table('permissions')->insert(['name' => 'supplier-delete']);
        DB::table('permissions')->insert(['name' => 'product-show']);
        DB::table('permissions')->insert(['name' => 'product-create']);
        DB::table('permissions')->insert(['name' => 'product-edit']);
        DB::table('permissions')->insert(['name' => 'product-delete']);
        DB::table('permissions')->insert(['name' => 'slider-show']);
        DB::table('permissions')->insert(['name' => 'slider-create']);
        DB::table('permissions')->insert(['name' => 'slider-edit']);
        DB::table('permissions')->insert(['name' => 'slider-delete']);
        DB::table('permissions')->insert(['name' => 'shippingcharge-show']);
        DB::table('permissions')->insert(['name' => 'shippingcharge-create']);
        DB::table('permissions')->insert(['name' => 'shippingcharge-edit']);
        DB::table('permissions')->insert(['name' => 'shippingcharge-delete']);
        DB::table('permissions')->insert(['name' => 'order-list']);
        DB::table('permissions')->insert(['name' => 'customer-list']);
        DB::table('permissions')->insert(['name' => 'orderItem-list']);
        DB::table('permissions')->insert(['name' => 'paypal-edit']);
        DB::table('permissions')->insert(['name' => 'banner-edit']);
        DB::table('permissions')->insert(['name' => 'country-show']);
        DB::table('permissions')->insert(['name' => 'country-create']);
        DB::table('permissions')->insert(['name' => 'country-edit']);
        DB::table('permissions')->insert(['name' => 'country-delete']);
        DB::table('permissions')->insert(['name' => 'blog-show']);
        DB::table('permissions')->insert(['name' => 'blog-create']);
        DB::table('permissions')->insert(['name' => 'blog-edit']);
        DB::table('permissions')->insert(['name' => 'blog-delete']);
        DB::table('permissions')->insert(['name' => 'newsletter-show']);
        DB::table('permissions')->insert(['name' => 'contact-edit']);
        DB::table('permissions')->insert(['name' => 'setting-edit']);
        DB::table('permissions')->insert(['name' => 'termsAndConditions-edit']);
        DB::table('permissions')->insert(['name'=> 'offer-show']);
DB::table('permissions')->insert(['name'=> 'offer-create']);
DB::table('permissions')->insert(['name'=> 'offer-edit']);
DB::table('permissions')->insert(['name'=> 'offer-delete']);

    }
}

