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
public function equipment()
{
    return $this->belongsTo(GymEquipment::class, 'equipment_id');
}


}
