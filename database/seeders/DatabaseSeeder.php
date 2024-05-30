<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Category, Customer, Opportunity};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UsersSeeder::class,
        ]);

        $customers = Customer::factory(100)->create();
        Opportunity::factory(5)->recycle($customers)->create();
        Category::factory(100)->create();
    }
}
