<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Water extends Model
{
    use HasFactory;
    protected $fillable = ['pump_name', 'total_water_used', 'last_maintenance', 'health_check'];
}
