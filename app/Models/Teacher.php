<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'user_id',
        'prenom',
        'nom_de_famille',
        'telephone',
        'email',
        'adresse',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_teacher', 'teacher_id', 'class_id');
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class, 'enseignant_id');
    }
    
}
