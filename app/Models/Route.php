<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    public $fillable = [
        'route',
        'fuel',
        'trip',
        'date',
        'drive_allowance',
        'vehicle_status',
        'vehicle_description',
        'cargo_id',
        'driver_id',
        'vehicle_id',
        'price',
        'mode',
        'description',
    ];


    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}
