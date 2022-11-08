<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'trip_id',
        'reservation_date',
        'number_of_adults',
        'number_of_children',
        'paid',
    ];

    public $timestamps = true;
}
