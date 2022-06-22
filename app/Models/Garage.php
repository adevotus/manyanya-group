<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    public $fillable = [
        'tool_name',
        'amount',
        'condition',
        'payment',
        'tool_no',
        'slip',
    ];
}
