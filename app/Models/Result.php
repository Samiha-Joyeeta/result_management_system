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

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'final_cgpa',
    ];

    public function student()
    {
        return $this->belongsTo(Profile::class, 'student_id', 'id');
    }
}
