<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'platenumber',
        'reg_number',
        'condition',
    ];

    public function route()
    {
        return $this->hasMany(Route::class);
    }
}
