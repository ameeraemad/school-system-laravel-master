<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function getStatusAttribute()
    {
        return $this->active ? "فعال" : "غير مفعل";
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, TeacherSubject::class, 'subject_id', 'teacher_id');
    }
}
