<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeAccess extends Model
{
    use HasFactory;

    protected $table = 'codes_access';

    protected $fillable = [
        'code',
        'status',
        'user_public_key',
        //'user_private_key',
        'user_id',
        'expiration_date',
    ];

    protected $casts = [
        'expiration_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    


}
