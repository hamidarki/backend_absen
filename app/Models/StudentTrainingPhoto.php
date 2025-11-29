<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTrainingPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'photo',
        'face_embedding'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
