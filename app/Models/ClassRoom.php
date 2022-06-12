<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    public function getStageArAttribute()
    {
        if ($this->stage == 'Primary') {
            return "إبتدائي";
        } elseif ($this->stage == 'Secondary') {
            return "إعدادي";
        } else {
            return "ثانوي";
        }
    }

    public function sections()
    {
        return $this->hasMany(SchoolClassRoom::class, 'class_room_id', 'id');
    }

    public function schoolSections()
    {
        return $this->belongsToMany(School::class, SchoolClassRoom::class, 'class_room_id', 'school_id');
    }
}
