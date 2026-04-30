<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    // Fields that can be mass-assigned
    protected $fillable = [
        'user_id',
        'gender',
        'weight',
        'height',
        'age',
        'activity_level',
        'goal',
    ];

    /**
     * Relationship: A profile belongs to a user.
     */
    public function user()
{
    return $this->belongsTo(User::class);
}
}
