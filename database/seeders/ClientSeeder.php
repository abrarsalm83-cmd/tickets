<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Ahmed Al-Farsi',
                'email' => 'ahmed.alfarsi@example.com',
                'tel' => '+967-700-123-456',
            ],
            [
                'name' => 'Sana Home Appliances',
                'email' => 'contact@sanaappliances.com',
                'tel' => '+967-701-234-567',
            ],
            [
                'name' => 'Mona Khaled',
                'email' => 'mona.khaled@example.com',
                'tel' => '+967-702-345-678',
            ],
            [
                'name' => 'Family Care Electronics',
                'email' => 'support@familycare-electronics.com',
                'tel' => '+967-703-456-789',
            ],
            [
                'name' => 'Omar & Sons',
                'email' => 'info@omarsons.com',
                'tel' => '+967-704-567-890',
            ],
            [
                'name' => 'Huda Home Solutions',
                'email' => 'hello@hudahomesolutions.com',
                'tel' => '+967-705-678-901',
            ],
            [
                'name' => 'Ali Home Appliances',
                'email' => 'ali.appliances@example.com',
                'tel' => '+967-706-789-012',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
    