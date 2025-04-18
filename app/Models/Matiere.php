<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $table = 'matieres';

    protected $fillable = [
        'nom',
        'description',
        'classe_id',
    ];

    public function classe()
    {
        return $this->belongsTo(ClassModel::class, 'classe_id');
    }

    public function enseignants()
    {
        return $this->belongsToMany(Teacher::class, 'matiere_enseignant', 'matiere_id', 'enseignant_id');
    }

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class, 'matiere_id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'matiere_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'matiere_id');
    }
}
