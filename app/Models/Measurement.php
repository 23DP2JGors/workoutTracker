<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
      use HasFactory;
    /**
     * The attributes that are mass assignable. (int, string)
     */
    protected $fillable = [
        'user_id',
        'measured_at',
        'weight',
        'neck',
        'chest',
        'biceps',
        'forearms',
        'waist',
        'hips',
        'calves',
        'notes',
    ];

    /**
     * The attributes that should be cast. (string, string)
     */
    protected $casts = [
        'measured_at' => 'date',
        'weight' => 'decimal:2',
        'neck' => 'decimal:2',
        'chest' => 'decimal:2',
        'biceps' => 'decimal:2',
        'forearms' => 'decimal:2',
        'waist' => 'decimal:2',
        'hips' => 'decimal:2',
        'calves' => 'decimal:2',
    ];

    /**
     * Get the user that owns the measurement.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
