<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'nom',
        'niveau_scolaire_id',
        'description',
    ];

    public function niveauScolaire()
    {
        return $this->belongsTo(NiveauScolaire::class, 'niveau_scolaire_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'classe_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher', 'class_id', 'teacher_id');
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class, 'classe_id');
    }

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class, 'classe_id');
    }
    
}
