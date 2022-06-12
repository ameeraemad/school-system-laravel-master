<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticatable
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

    public function parent()
    {
        return $this->belongsTo(StudentParent::class, 'parent_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, SchoolClassRoomStudent::class, 'student_id', 'school_class_room_id');
    }
}
