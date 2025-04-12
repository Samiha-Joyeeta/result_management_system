<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use App\Models\Semester;
use App\Models\AssignedCourse;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $fillable = [
        'course_id',
        'exam_title',
        'dept_id',
        'semester',
        'exam_type',
        'marks',
        'instructor_id',
        'created_by',
    ];

    const EXAM_TYPE_MID = 1;
    const EXAM_TYPE_QUIZ = 2;
    const EXAM_TYPE_VIVA = 3;
    const EXAM_TYPE_FINAL = 4;

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'exam_id', 'id');
    }
}
