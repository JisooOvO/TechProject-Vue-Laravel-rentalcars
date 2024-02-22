<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'start_at',
        'end_at',
        'reservation_status',
        'rental_fee',
        'additional_information'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }    
}