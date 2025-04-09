<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\CustomerController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\TenantAuthController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/



Route::middleware([InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class, 'web'])->group(function () {
    // Tenant login routes
    Route::get('/tenant/login', [TenantAuthController::class, 'showLoginForm'])->name('tenant.login');
    Route::post('/tenant/login', [TenantAuthController::class, 'login']);
    Route::post('/tenant/logout', [TenantAuthController::class, 'logout'])->name('tenant.logout');

    // Welcome route
    Route::get('/', function () {
        return view('Tenants.welcome');
    });

    Route::get('/customers', [CustomerController::class, 'index'])->name('tenant.home');
    // Customer routes
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('tenant.customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('tenant.customers.store');
});
