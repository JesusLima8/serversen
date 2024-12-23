<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_visible', 'location', 'latitude', 'longitude',];

    public function readings()
    {
        return $this->hasMany(Reading::class);
    }
}
