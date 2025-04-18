<?php

namespace App\Http\Controllers;

use App\Models\NiveauScolaire;
use Illuminate\Http\Request;

class NiveauScolaireController extends Controller
{
    public function index()
    {
        $niveaux = NiveauScolaire::orderBy('ordre')->get();
        return view('niveaux_scolaires.index', compact('niveaux'));
    }

    public function create()
    {
        return view('niveaux_scolaires.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:niveaux_scolaires',
            'description' => 'nullable|string',
            'ordre' => 'required|integer|min:0',
        ]);

        NiveauScolaire::create($validated);

        return redirect()->route('niveaux_scolaires.index')->with('success', 'Niveau scolaire créé avec succès.');
    }

    public function show(NiveauScolaire $niveauScolaire)
    {
        $niveauScolaire->load('classes.teachers');
        return view('niveaux_scolaires.show', compact('niveauScolaire'));
    }

    public function edit(NiveauScolaire $niveauScolaire)
    {
        return view('niveaux_scolaires.edit', compact('niveauScolaire'));
    }

    public function update(Request $request, NiveauScolaire $niveauScolaire)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:niveaux_scolaires,nom,' . $niveauScolaire->id,
            'description' => 'nullable|string',
            'ordre' => 'required|integer|min:0',
        ]);

        $niveauScolaire->update($validated);

        return redirect()->route('niveaux_scolaires.index')->with('success', 'Niveau scolaire mis à jour avec succès.');
    }

    public function destroy(NiveauScolaire $niveauScolaire)
    {
        if ($niveauScolaire->classes()->exists()) {
            return redirect()->route('niveaux_scolaires.index')->with('error', 'Impossible de supprimer un niveau scolaire avec des classes associées.');
        }

        $niveauScolaire->delete();

        return redirect()->route('niveaux_scolaires.index')->with('success', 'Niveau scolaire supprimé avec succès.');
    }
}
