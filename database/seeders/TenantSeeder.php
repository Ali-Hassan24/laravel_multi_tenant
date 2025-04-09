<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Facades\Tenancy;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create the tenant
        $tenant = Tenant::create([
            'name' => 'Demo Tenant',
            'email' => 'tenant@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create the domain
        $tenant->domains()->create([
            'domain' => 'demo.' . config('app.domain'), // e.g., demo.localhost
        ]);
    }
}
