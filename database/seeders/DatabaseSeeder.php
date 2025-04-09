<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
//            TenantSeeder::class,
        ]);

//         Tenant::factory(5)->create();
//
//        Tenant::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//            'password' => '123456789',
//        ]);
    }
}
