<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;
    
    protected $table = 'Profile';
    protected $fillable = [
        'user_id',
        'registration_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

