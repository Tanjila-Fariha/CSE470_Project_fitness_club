<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gym_equipment extends Model
{
protected $fillable = [
    'product_name',
    'product_image',
    'product_description',
    'price',
    'quantity',
];

}
