<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = [
        'role_id',
        'can_request_reservation',
        'can_access_dashboard',
        'can_manage_user',
        'can_manage_reservation',
        'can_manage_role',
        'can_manage_notification'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
