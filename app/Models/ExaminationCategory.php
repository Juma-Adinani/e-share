<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationCategory extends Model
{
    use HasFactory;

    public function examMaterialDocument()
    {
        return $this->hasMany(ExamMaterialDocument::class);
    }
}
