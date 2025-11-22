<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the initial 10% package
        Package::create([
            'name' => 'Premium',
            'description' => 'Best value for high-volume schools with lower platform fee',
            'system_percentage' => 10,
            'school_percentage' => 90,
            'is_active' => true,
            'sort_order' => 1,
            'features' => [
                'Lower platform fee',
                'Higher school earnings',
                'All standard features',
            ],
        ]);
    }
}
