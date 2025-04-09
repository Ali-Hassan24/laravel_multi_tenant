<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use App\Models\Tenant;
class Domain extends Model
{
    use BelongsToTenant;

    protected $fillable = ['domain'];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
