<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MotorCategory extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Define the relationship with the Motor model
    public function motors(): HasMany
    {
        return $this->hasMany(Motor::class);
    }
}
