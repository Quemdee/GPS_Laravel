<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GpsData extends Model
{
    use HasFactory;

    // Fields that are mass assignable
    protected $fillable = ['latitude', 'longitude'];
}
