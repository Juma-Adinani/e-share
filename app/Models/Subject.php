<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = true;

    public function examMaterialDoc()
    {
        return $this->hasMany(ExamMaterialDocument::class);
    }

    public function teacher_subjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function subjecttopics()
    {
        return $this->hasMany(SubjectTopic::class);
    }
}
