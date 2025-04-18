<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::with(['classe', 'enseignant'])->get();
        return view('matieres.index', compact('matieres'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $teachers = Teacher::all();
        return view('matieres.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'classe_id' => 'required|exists:classes,id',
            'enseignant_id' => 'required|exists:teachers,id',
        ]);

        Matiere::create($validated);

        return redirect()->route('matieres.index')->with('success', 'Matière créée avec succès.');
    }
}
