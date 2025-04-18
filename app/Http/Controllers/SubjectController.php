<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Affiche la liste des matières
     */
    public function index()
    {
        $matieres = Matiere::orderBy('nom')->paginate(10);
        return view('matieres.index', compact('matieres'));
    }

    /**
     * Affiche le formulaire de création d'une matière
     */
    public function create()
    {
        return view('matieres.create');
    }

    /**
     * Enregistre une nouvelle matière
     */
    public function store(Request $request)
    {

        // id	nom	description	classe_id	enseignant_id	created_at	updated_at

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255|unique:subjects,nom',
            'description'=> 'nullable|string',
            'classe_id'=> 'nullable|',
            'enseignant_id'=> 'required|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Matiere::create($request->all());

        return redirect()->route('matieres.index')
            ->with('success', 'Matière créée avec succès.');
    }

    /**
     * Affiche les détails d'une matière
     */
    public function show(Subject $matiere)
    {
        return view('matieres.show', compact('matiere'));
    }

    /**
     * Affiche le formulaire d'édition d'une matière
     */
    public function edit(Subject $matiere)
    {
        return view('matieres.edit', compact('matiere'));
    }

    /**
     * Met à jour une matière existante
     */
    public function update(Request $request, Subject $matiere)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255|unique:subjects,nom,' . $matiere->id,
            'code' => 'required|string|max:50|unique:subjects,code,' . $matiere->id,
            'description' => 'nullable|string',
            'coefficient' => 'required|numeric|min:1|max:10',
            'niveau_scolaire' => 'required|string|max:100'
        ], [
            'nom.required' => 'Le nom de la matière est obligatoire.',
            'code.required' => 'Le code de la matière est obligatoire.',
            'coefficient.required' => 'Le coefficient est obligatoire.',
            'coefficient.numeric' => 'Le coefficient doit être un nombre.',
            'coefficient.min' => 'Le coefficient doit être au moins 1.',
            'coefficient.max' => 'Le coefficient ne peut pas dépasser 10.',
            'niveau_scolaire.required' => 'Le niveau scolaire est obligatoire.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $matiere->update($request->all());

        return redirect()->route('matieres.index')
            ->with('success', 'Matière mise à jour avec succès.');
    }

    /**
     * Supprime une matière
     */
    public function destroy(Subject $matiere)
    {
        $matiere->delete();

        return redirect()->route('matieres.index')
            ->with('success', 'Matière supprimée avec succès.');
    }
}
