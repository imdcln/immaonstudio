<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = "reservations";
    protected $fillable = ['user_id', 'status_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(ReservationStatus::class);
    }

    public function details()
    {
        return $this->hasMany(ReservationDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(ReservationReview::class);
    }
}
