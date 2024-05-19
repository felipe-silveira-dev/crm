<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    public function run(): void
    {
        Opportunity::factory(100)->create([
            'customer_id' => rand(1, 100),
        ]);
    }
}
