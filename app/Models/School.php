<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class School extends Authenticatable
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
                return "ذكور";
            case "F":
                return "إناث";
            case "MF":
                return "ذكور - إناث";
        }
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'student_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(SchoolClassRoom::class, 'school_id', 'id');
    }

    public function classRoomSections()
    {
        return $this->belongsToMany(ClassRoom::class, SchoolClassRoom::class, 'school_id', 'class_room_id');
    }
}
