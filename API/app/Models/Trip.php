<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'trips';

    protected $primaryKey = 'id';

    protected $fillable = [
        'city_id',
        'number_of_days',
        'departure_date',
        'price',
    ];

    public $timestamps = true;
}
