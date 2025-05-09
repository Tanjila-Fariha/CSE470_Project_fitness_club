<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    protected $fillable = [
        'equipment_id',
        'name',
        'phone',
        'address',
        'delivery_option'
    ];
}
