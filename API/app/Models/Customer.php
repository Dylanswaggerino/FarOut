<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'id';

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "address",
        "postal_code",
        "city",
        "country_code",
        "phone",
    ];

    public $timestamps = true;

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'customer_id', 'id');
    }
}
