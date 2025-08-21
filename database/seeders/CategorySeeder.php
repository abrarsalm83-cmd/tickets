<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\User;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user
        $adminUser = User::first();

        // Get category types
        $appliances = CategoryType::where('name', 'Appliances')->first();
        $furniture = CategoryType::where('name', 'Furniture')->first();
        $installation = CategoryType::where('name', 'Installation & Setup')->first();
        $warranty = CategoryType::where('name', 'Warranty & Service')->first();

        $categories = [
            // Appliances Categories
            [
                'name' => 'Washing Machine Not Spinning',
                'description' => 'Washing machine drum not rotating or stuck during cycle',
                'type_id' => $appliances->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
            [
                'name' => 'Refrigerator Not Cooling',
                'description' => 'Refrigerator fails to maintain temperature or ice formation issues',
                'type_id' => $appliances->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
            [
                'name' => 'Microwave Not Heating',
                'description' => 'Microwave oven turns on but does not heat food properly',
                'type_id' => $appliances->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
            [
                'name' => 'Air Conditioner Leakage',
                'description' => 'AC water leakage or insufficient cooling',
                'type_id' => $appliances->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],

            // Furniture Categories
            [
                'name' => 'Sofa Tear / Damage',
                'description' => 'Sofa fabric ripped or cushions damaged',
                'type_id' => $furniture->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
            [
                'name' => 'Bed Frame Issue',
                'description' => 'Bed frame broken or squeaky',
                'type_id' => $furniture->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],

            // Installation & Setup Categories
            [
                'name' => 'Appliance Installation',
                'description' => 'Request to install new appliances like fridge, washing machine, AC',
                'type_id' => $installation->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
            [
                'name' => 'Furniture Assembly',
                'description' => 'Request to assemble furniture like beds, wardrobes, sofas',
                'type_id' => $installation->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],

            // Warranty & Service Categories
            [
                'name' => 'Warranty Claim',
                'description' => 'Request to process a warranty claim for defective products',
                'type_id' => $warranty->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
            [
                'name' => 'Service Request',
                'description' => 'Request for general maintenance or service of appliances',
                'type_id' => $warranty->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
            [
                'name' => 'Replacement Parts',
                'description' => 'Request for replacement parts for appliances or furniture',
                'type_id' => $warranty->id,
                'created_by' => $adminUser->id,
                'user_id' => $adminUser->id,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
