<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    public $fillable = [
        'customername',
        'customerphone',
        'customeremail',
        'name',
        'amount',
        'weight',
        'total',
        'invoice',
        'payment'
    ];

    public function route()
    {
        return $this->hasMany(Route::class);
    }
}
