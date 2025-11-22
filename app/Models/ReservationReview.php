<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationReview extends Model
{
    protected $table = "reservation_reviews";
    protected $fillable = ['user_id', 'reservation_id', 'rating', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
