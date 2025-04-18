<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClassModel;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = DB::table('classes')->paginate(10);
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        DB::table('classes')->insert([
            'nom' => $request->nom,
            'niveau' => $request->niveau,
            'description' => $request->description,
            'created_at' => now(),
        ]);

        return redirect()->route('classes.index')->with('success', 'Classe créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassModel $classModel)
    {
        return view('classes.show', compact('classModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModel $classModel)
    {
        return view('classes.edit', compact('classModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModel $classModel)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $classModel->update([
            'nom' => $request->nom,
            'niveau' => $request->niveau,
            'description' => $request->description,
        ]);

        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModel $classModel)
    {
        $classModel->delete();
        return redirect()->route('classes.index')->with('success', 'Classe supprimée avec succès.');
    }
}
