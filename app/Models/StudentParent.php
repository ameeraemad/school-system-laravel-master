<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class StudentParent extends Authenticatable
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
                return "أب";
            case "F":
                return "أم";
        }
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'parent_id', 'id');
    }
}
