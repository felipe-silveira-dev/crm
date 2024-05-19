<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Customer, Opportunity};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UsersSeeder::class,
        ]);

        $customers     = Customer::factory(100)->create();
        $opportunities = Opportunity::factory(300)->recycle($customers)->create();
    }
}
