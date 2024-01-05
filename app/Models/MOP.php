<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOP extends Model
{
    use HasFactory;

    // Define table fields
    protected $fillable = [
        'name',
        'description',
        'script',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
