<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTopic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topics()
    {
        return $this->belongsTo(SubjectTopic::class);
    }

    public function quiz()
    {
        return $this->belongsToMany(Quiz::class);
    }
}
