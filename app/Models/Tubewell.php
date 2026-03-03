<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tubewell extends Model
{
    use HasFactory;

    protected $fillable = ['lat', 'lng', 'status', 'area_name', 'is_verified'];
}