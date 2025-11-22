<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationType extends Model
{
    protected $table = "reservation_types";
    protected $fillable = ['name'];

    public function details()
    {
        return $this->hasMany(ReservationDetail::class, 'type_id');
    }
}

