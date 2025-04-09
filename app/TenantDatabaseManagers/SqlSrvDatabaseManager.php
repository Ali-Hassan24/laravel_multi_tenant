<?php

namespace App\TenantDatabaseManagers;

use Stancl\Tenancy\Contracts\TenantDatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SqlSrvDatabaseManager implements TenantDatabaseManager
{
    public function createDatabase(string $name): void
    {
        $connection = DB::connection('sqlsrv');
        $connection->statement("CREATE DATABASE [$name]");
    }

    public function deleteDatabase(string $name): void
    {
        $connection = DB::connection('sqlsrv');
        $connection->statement("DROP DATABASE [$name]");
    }

    public function migrateDatabase(string $name): void
    {
        Artisan::call('tenants:migrate', [
            '--tenants' => $name,
            '--force' => true,
        ]);
    }
}
