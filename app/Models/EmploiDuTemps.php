<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    protected $table = 'emplois_du_temps';

    protected $fillable = [
        'classe_id',
        'matiere_id',
        'jour',
        'heure_debut',
        'heure_fin',
        'titre_fichier',
        'chemin_fichier',
        'type_fichier',
        'extension_fichier',
        'taille_fichier',
    ];

    protected $casts = [
        'jour' => 'string', // Enum: 'lundi', 'mardi', etc.
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'type_fichier' => 'string', // Enum: 'pdf', 'image'
    ];

    public function classe()
    {
        return $this->belongsTo(ClassModel::class, 'classe_id');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }
}
