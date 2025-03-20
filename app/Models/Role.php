<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Permission;
use App\Models\User;

class Role extends SpatieRole
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'guard_name'];

    /**
     * Define relationship with permissions.
     */
  /**
 * Define relationship with permissions.
 */
public function permissions(): BelongsToMany
{
    return $this->belongsToMany(Permission::class, config('permission.table_names.role_has_permissions'));
}

/**
 * Define relationship with users.
 */
public function users(): MorphToMany
{
    return $this->morphedByMany(User::class, 'model', config('permission.table_names.model_has_roles'));
}

}
