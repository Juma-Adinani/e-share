<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function teacher_subjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function examMaterialDocuments()
    {
        return $this->hasMany(ExamMaterialDocument::class);
    }
}
