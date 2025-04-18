<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\NiveauScolaire;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with(['niveauScolaire', 'teachers'])->get();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $niveaux = NiveauScolaire::all();
        $teachers = Teacher::all();
        return view('classes.create', compact('niveaux', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'niveau_scolaire_id' => 'required|exists:niveaux_scolaires,id',
            'description' => 'nullable|string',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        $classe = ClassModel::create($validated);

        if ($request->filled('teacher_ids')) {
            $classe->teachers()->sync($request->teacher_ids);
        }

        return redirect()->route('classes.index')->with('success', 'Classe créée avec succès.');
    }

    public function show(ClassModel $classe)
    {
        $classe->load(['niveauScolaire', 'teachers', 'students']);
        return view('classes.show', compact('classe'));
    }

    public function edit(ClassModel $classe)
    {
        $niveaux = NiveauScolaire::all();
        $teachers = Teacher::all();
        return view('classes.edit', compact('classe', 'niveaux', 'teachers'));
    }

    public function update(Request $request, ClassModel $classe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'niveau_scolaire_id' => 'required|exists:niveaux_scolaires,id',
            'description' => 'nullable|string',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        $classe->update($validated);

        if ($request->filled('teacher_ids')) {
            $classe->teachers()->sync($request->teacher_ids);
        } else {
            $classe->teachers()->detach();
        }

        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroy(ClassModel $classe)
    {
        if ($classe->students()->exists() || $classe->matieres()->exists()) {
            return redirect()->route('classes.index')->with('error', 'Impossible de supprimer une classe avec des élèves ou des matières associées.');
        }

        $classe->teachers()->detach();
        $classe->delete();

        return redirect()->route('classes.index')->with('success', 'Classe supprimée avec succès.');
    }
}
