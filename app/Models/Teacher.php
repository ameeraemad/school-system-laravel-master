<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Teacher extends Authenticatable
{
    use HasFactory, HasRoles;

    public function getStatusAttribute()
    {
        return $this->active ? "فعال" : "غير مفعل";
    }

    public function getGenderTypeAttribute()
    {
        switch ($this->gender) {
            case 'M':
                return "ذكر";
            case "F":
                return "أنثى";
        }
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, TeacherSubject::class, 'teacher_id', 'subject_id');
    }

    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class, 'teacher_id', 'id');
    }
}
