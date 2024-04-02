<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','priority' ,'user_id', 'assigned_to', 'status', 'closed_at', 'assigned_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
