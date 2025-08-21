<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryType;
use App\Models\User;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user or create one if none exists
        $adminUser = User::first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@tickets.com',
                'password' => bcrypt('password'),
            ]);
        }

        $categoryTypes = [
            [
                'name' => 'Appliances',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Furniture',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Installation & Setup',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Warranty & Service',
                'created_by' => $adminUser->id,
            ],
        ];

        foreach ($categoryTypes as $categoryType) {
            CategoryType::create($categoryType);
        }
    }
}
