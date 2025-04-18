<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $parent = ParentModel::orderBy("id","desc")->paginate(10);
        return view('parents.index', compact('parent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //id	utilisateur_id	prenom	nom_de_famille	telephone	created_at	updated_at
        $validated = $request->validate([
            'utilisateur_id' => auth()->user()->id,
            'prenom' => 'required|string|max:255',
            'nom_de_famille' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',

        ]);
        $parent = parent::create($validated);
        return redirect()->route('parents.index')->with('success','parent created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ParentModel $parentModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParentModel $parentModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParentModel $parentModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParentModel $parentModel)
    {
        //
    }
}
