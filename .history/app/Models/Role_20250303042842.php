<?php

namespace App\Models;

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
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, config('permission.table_names.role_has_permissions'));
    }

    /**
     * Define relationship with users (assuming your user model uses HasRoles).
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'model', config('permission.table_names.model_has_roles'));
    }
}
