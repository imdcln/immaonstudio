<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $table = "reservation_details";

    protected $fillable = [
        'reservation_id', 
        'reservation_date', 
        'start', 
        'end', 
        'type_id', 
        'descriptions'
    ];

    protected $casts = [
        'start' => 'datetime:H:i:s',
        'end' => 'datetime:H:i:s',
        'reservation_date' => 'date:Y-m-d'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function type()
    {
        return $this->belongsTo(ReservationType::class, 'type_id');
    }
}
