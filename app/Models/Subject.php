<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'class_id', 'teacher_id',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}
