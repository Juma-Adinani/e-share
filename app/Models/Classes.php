<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    public function teacher_subjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function material_documents()
    {
        return $this->hasMany(ExamMaterialDocument::class);
    }
}
