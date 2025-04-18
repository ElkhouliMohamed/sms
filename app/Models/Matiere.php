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
        'enseignant_id',
    ];

    public function classe()
    {
        return $this->belongsTo(ClassModel::class, 'classe_id');
    }

    public function enseignant()
    {
        return $this->belongsTo(Teacher::class, 'enseignant_id');
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
