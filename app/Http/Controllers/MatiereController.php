<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Teacher;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatiereController extends Controller
{
    // Afficher toutes les matières
    public function index()
    {
        $matieres = Matiere::with(['classe', 'enseignants'])->get();
        return view('matieres.index', compact('matieres'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $classes = ClassModel::all();
        $enseignants = Teacher::all();
        return view('matieres.create', compact('classes', 'enseignants'));
    }

    // Enregistrer une nouvelle matière
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'classe_id' => 'required|exists:class_models,id',
            'enseignant_ids' => 'required|array',
            'enseignant_ids.*' => 'exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $matiere = Matiere::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'classe_id' => $request->classe_id,
        ]);

        // Assigner les enseignants à la matière
        $matiere->enseignants()->attach($request->enseignant_ids);

        return redirect()->route('matieres.index')->with('success', 'Matière créée avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit(Matiere $matiere)
    {
        $classes = ClassModel::all();
        $enseignants = Teacher::all();
        $selectedEnseignants = $matiere->enseignants->pluck('id')->toArray();
        return view('matieres.edit', compact('matiere', 'classes', 'enseignants', 'selectedEnseignants'));
    }

    // Mettre à jour une matière
    public function update(Request $request, Matiere $matiere)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'classe_id' => 'required|exists:class_models,id',
            'enseignant_ids' => 'required|array',
            'enseignant_ids.*' => 'exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $matiere->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'classe_id' => $request->classe_id,
        ]);

        // Synchroniser les enseignants
        $matiere->enseignants()->sync($request->enseignant_ids);

        return redirect()->route('matieres.index')->with('success', 'Matière mise à jour avec succès.');
    }

    // Supprimer une matière
    public function destroy(Matiere $matiere)
    {
        $matiere->enseignants()->detach(); // Supprimer les relations avec les enseignants
        $matiere->delete();
        return redirect()->route('matieres.index')->with('success', 'Matière supprimée avec succès.');
    }
}
