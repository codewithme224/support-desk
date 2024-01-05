<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    // Define table fields
    protected $fillable = [
        'start_time',
        'end_time',
        'shift_id',
        // ... other fields as needed
    ];

    // Relationships
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
