<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolAdmin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
