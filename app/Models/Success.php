<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// cla extends Model
// {
//     //
// }
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Sucess extends Model
// {
//     use HasFactory;

//     protected $fillable = ['story'];
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class success extends Model
{
    use HasFactory;

    protected $fillable = ['story']; // ✅ Make 'story' fillable
}


