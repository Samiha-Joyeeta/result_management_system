<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Result;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $fillable = [
        'name',
        'credit',
        'department_id',
        'created_by',
        'status'
    ];

    const COURSE_STATUS_ACTIVE = 1;
    const COURSE_STATUS_INACTIVE = 0;

    public function exams()
    {
        return $this->hasMany(Exam::class, 'course_id', 'id');
    }

    public function assigned_courses()
    {
        return $this->hasMany(AssignedCourse::class, 'course_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'course_id', 'id');
    }
}
