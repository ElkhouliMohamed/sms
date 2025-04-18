<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'eleves';

    protected $fillable = [
        'utilisateur_id',
        'prenom',
        'nom_de_famille',
        'image',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'pays',
        'sexe',
        'etat_civil',
        'nationalite',
        'numero_identite',
        'nom_tuteur',
        'telephone_tuteur',
        'adresse_tuteur',
        'date_de_naissance',
        'classe_id',
    ];

    protected $casts = [
        'date_de_naissance' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function classe()
    {
        return $this->belongsTo(ClassModel::class, 'classe_id');
    }

    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'parent_eleve', 'eleve_id', 'parent_id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'eleve_id');
    }

    public function grades()
    {
        return $this->hasMany(Note::class, 'eleve_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'eleve_id');
    }

    public function transports()
    {
        return $this->belongsToMany(Transport::class, 'eleve_transport', 'eleve_id', 'transport_id')
            ->withPivot('date_debut', 'date_fin');
    }
}
