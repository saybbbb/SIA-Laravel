<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    protected $fillable = ['pump_name', 'total_water_used', 'last_maintenance', 'health_check'];
}
