<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    protected $fillable = [
        'description',
        'price',
        'installed',
        'remaining',
        'route_id',
        'payment_method',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
