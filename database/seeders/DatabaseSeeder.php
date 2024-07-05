<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'phone_number' => '081225648652',
            'role' => 'owner',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '081225648654',
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => bcrypt('password')
        ]);

        Category::create([
            'category_name' => 'liquid',
        ]);
        Category::create([
            'category_name' => 'pod',
        ]);
        Category::create([
            'category_name' => 'mod',
        ]);
        Category::create([
            'category_name' => 'cartridge',
        ]);

        Product::create([
            'product_name' => 'Liquid 60ml 3mg',
            'product_quantity' => 10,
            'price' => 100000,
            'category_id' => 1,
        ]);
        Product::create([
            'product_name' => 'Cartridge 0.3 ohm',
            'product_quantity' => 12,
            'price' => 30000,
            'category_id' => 4,
        ]);
        Product::create([
            'product_name' => 'POD 400Mah',
            'product_quantity' => 1,
            'price' => 200000,
            'category_id' => 2,
        ]);
    }
}
