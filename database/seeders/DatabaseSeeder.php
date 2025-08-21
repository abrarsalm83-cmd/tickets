<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the main admin user first
        $user = User::create([
            'name' => 'Abrar Salem',
            'email' => 'abrarsalm83@gmail.com',
            'password' => 'abrar12#$',
            'is_admin' => true,
            'birth_date' => '2005-09-14',
        ]);

        // Call the seeders in order
        $this->call([
            CategoryTypeSeeder::class,
            CategorySeeder::class,
            ClientSeeder::class,
        ]);
    }
}
