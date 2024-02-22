<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand_id',
        'model_name',
        'image_name',
        'image_path',
        'type_id',
        'year',
        'fuel_id',
        'seater',
        'option',
        'age_limit',
        'experience_limit',
        'rental_fee',
        'total_quantity',
        'available_quantity'
    ];

    public function brand()
    {
        return $this -> belongsTo(Brand::class);
    }

    public function type()
    {
        return $this -> belongsTo(Type::class);
    }

    public function fuel()
    {
        return $this -> belongsTo(Fuel::class);
    }

    public function reservation()
    {
        return $this -> hasMany(Reservation::class);
    }

}

