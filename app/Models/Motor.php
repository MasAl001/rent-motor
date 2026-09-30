<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Motor extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = [
        'motor_category_id',
        'merk',
        'color',
        'model',
        'year',
        'plate_number',
        'price_per_day',
        'deposit',
        'description',
        'image',
        'status',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'price_per_day' => 'decimal:2',
        'deposit' => 'decimal:2',
    ];

    // Define the relationship with the MotorCategory model
    public function category(): BelongsTo
    {
        return $this->belongsTo(MotorCategory::class, 'motor_category_id');
    }
}
