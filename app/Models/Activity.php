<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'description',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
