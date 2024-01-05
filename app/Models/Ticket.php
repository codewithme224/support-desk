<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Define table fields
    protected $fillable = [
        'issue',
        'status_id',
        'resolution',
        'mop',
        'shift_id',  // Assuming a relationship with Shift model
        'user_id',   // Assuming a relationship with User model
    ];

    // Relationships (adjust based on your specific relationships)
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function mop()
    {
        return $this->belongsTo(MOP::class, 'mop_id');
    }
}
