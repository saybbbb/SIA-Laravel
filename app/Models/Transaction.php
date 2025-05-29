<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'water_id',
        'supplier_id',
        'transaction_date',
        'total_water_used',
    ];

    public function water()
    {
        return $this->belongsTo(Water::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
