<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use App\Models\ClassModel;
use App\Models\Matiere;
use Illuminate\Http\Request;

class EmploiDuTempsController extends Controller
{
    public function index()
    {
        $emplois = EmploiDuTemps::with(['classe', 'matiere'])->get();
        return view('emplois_du_temps.index', compact('emplois'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $matieres = Matiere::all();
        return view('emplois_du_temps.create', compact('classes', 'matieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'matiere_id' => 'required|exists:matieres,id',
            'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'titre_fichier' => 'nullable|string|max:255',
            'chemin_fichier' => 'nullable|string|max:255',
            'type_fichier' => 'nullable|in:pdf,image',
            'extension_fichier' => 'nullable|string|max:10',
            'taille_fichier' => 'nullable|integer',
        ]);

        EmploiDuTemps::create($validated);

        return redirect()->route('emplois_du_temps.index')->with('success', 'Emploi du temps créé avec succès.');
    }
}
