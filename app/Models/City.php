<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function getStatusAttribute()
    {
        return $this->active ? "فعال" : "غير مفعل";
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'city_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'city_id', 'id');
    }
}
