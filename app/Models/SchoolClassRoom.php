<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClassRoom extends Model
{
    use HasFactory;

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, SchoolClassRoomStudent::class, 'school_class_room_id', 'student_id');
    }

    public function classRoomStudents()
    {
        return $this->hasMany(SchoolClassRoomStudent::class, 'school_class_room_id', 'id');
    }
}
