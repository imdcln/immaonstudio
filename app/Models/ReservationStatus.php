<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    protected $table = "reservation_status";
    protected $fillable = ['status'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'status_id');
    }
}
