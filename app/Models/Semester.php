<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use App\Models\AssignedCourse;
use App\Models\Exam;
use App\Models\Mark;

class Semester extends Model
{
    use HasFactory;
    protected $table = "semesters";
    protected $fillable = [
        'name',
        'created_by',
    ];

    public function assigned_courses()
    {
        return $this->hasMany(AssignedCourse::class, 'semester_id', 'id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'semester_id', 'id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'semester_id', 'id');
    }
}
