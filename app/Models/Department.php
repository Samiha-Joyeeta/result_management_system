<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\User;

class Department extends Model
{
    use HasFactory;
    protected $table = "departments";
    protected $fillable = [
        'name',
        'created_by',
    ];

    public function profiles()
    {
        return $this->hasMany(Profile::class, 'department_id', 'id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'department_id', 'id');
    }

    public function assigned_courses()
    {
        return $this->hasMany(AssignedCourse::class, 'department_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'department_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'department_id', 'id');
    }
}
