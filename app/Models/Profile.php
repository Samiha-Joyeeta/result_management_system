<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Mark;

class Profile extends Model
{
    use HasFactory;
    
    protected $table = 'Profiles';
    protected $fillable = [
        'user_id',
        'registration_number',
        'first_name',
        'last_name',
        'middle_name',
        'department_id',
        'session',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function department()
    {
        return $this->belongsto(Department::class, 'department_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'student_id', 'id');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'student_id', 'id');
    }
}

