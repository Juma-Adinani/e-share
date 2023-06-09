<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTopic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function subtopics(){
        return $this->hasMany(SubTopic::class);
    }

}
