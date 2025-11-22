<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $fillable = ['role'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permission()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
