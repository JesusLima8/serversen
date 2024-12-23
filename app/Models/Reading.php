<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'temperature', 'humidity', 'created_at'];
    public $timestamps = false; // Deshabilitar timestamps automáticos
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
