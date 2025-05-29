<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'contact_number'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
