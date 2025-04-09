<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Stancl\Tenancy\Database\Models\Domain;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->orderBy('id', 'desc')->paginate(10);
        return view('Tenants.index', compact('tenants'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'domain_name' => 'required|string|alpha_dash|unique:domains,domain',
        ]);

        // Slugify the subdomain (e.g. "My Shop" -> "my-shop")
        $subdomain = Str::slug($validated['domain_name']);

        // Fetch the central domain like: "example.com"
        $centralDomain = config('tenancy.central_domains')[0] ?? null;

        if (!$centralDomain) {
            return back()->withInput()->with('error', 'Central domain not configured. Please check tenancy config.');
        }

        // Build full domain: sub.example.com
        $fullDomain = "{$subdomain}.{$centralDomain}";

        // Check if the domain already exists
        if (Domain::where('domain', $fullDomain)->exists()) {
            return back()->withInput()->with('error', 'This domain already exists. Try a different subdomain.');
        }

        // Create the tenant
        $tenant = Tenant::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'], // auto-hashed in model
        ]);

        // Attach domain
        $tenant->domains()->create([
            'domain' => $fullDomain,
        ]);

        return redirect()->route('Tenants.index')->with('success', 'Tenant and domain created successfully.');
    }





    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);

        // Optional: add authorization if needed
        // $this->authorize('delete', $tenant);

        // Delete associated domains (if any)
        $tenant->domains()->delete();

        // Delete the tenant
        $tenant->delete();

        return redirect()->route('Tenants.index')->with('success', 'Tenant deleted successfully');
    }


}
