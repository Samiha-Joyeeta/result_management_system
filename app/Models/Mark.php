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

class Mark extends Model
{
    use HasFactory;
    protected $table = 'marks';
    protected $fillable = [
        'student_id',
        'exam_id',
        'course_id',
        'marks',
        'semester_id'
    ];

    public function student()
    {
        return $this->belongsTo(Profile::class, 'student_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
