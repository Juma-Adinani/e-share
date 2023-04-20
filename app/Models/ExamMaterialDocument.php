<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMaterialDocument extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function exam_materials()
    {
        return $this->belongsTo(ExamMaterial::class, 'material_id');
    }

    public function exam_categories()
    {
        return $this->belongsTo(ExaminationCategory::class, 'exam_id');
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
