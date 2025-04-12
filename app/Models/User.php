<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Profile;
use App\Models\Exam;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $fillable = [
        'username',
        'registration_number',
        'email',
        'password',
        'phone_number',
        'user_type',
        'status'
    ];

    const USER_TYPE_ADMIN = 1;
    const USER_TYPE_INSTRUCTOR = 2;
    const USER_TYPE_STUDENT = 3;
    
    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_INACTIVE = 0;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'instructor_id', 'id');
    }

    public function assigned_courses()
    {
        return $this->hasMany(AssignedCourse::class, 'created_by', 'id');
    }
}
