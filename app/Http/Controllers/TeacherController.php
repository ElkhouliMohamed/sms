<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['user', 'classes'])->get();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $users = User::all();
        $classes = ClassModel::all();
        return view('teachers.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:teachers,user_id',
            'prenom' => 'required|string|max:255',
            'nom_de_famille' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:teachers,email',
            'adresse' => 'nullable|string|max:255',
            'class_ids' => 'nullable|array',
            'class_ids.*' => 'exists:classes,id',
        ]);

        $teacher = Teacher::create($validated);

        if ($request->filled('class_ids')) {
            $teacher->classes()->sync($request->class_ids);
        }

        return redirect()->route('teachers.index')->with('success', 'Enseignant créé avec succès.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load(['user', 'classes', 'matieres']);
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $users = User::all();
        $classes = ClassModel::all();
        return view('teachers.edit', compact('teacher', 'users', 'classes'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:teachers,user_id,' . $teacher->id,
            'prenom' => 'required|string|max:255',
            'nom_de_famille' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'adresse' => 'nullable|string|max:255',
            'class_ids' => 'nullable|array',
            'class_ids.*' => 'exists:classes,id',
        ]);

        $teacher->update($validated);

        if ($request->filled('class_ids')) {
            $teacher->classes()->sync($request->class_ids);
        } else {
            $teacher->classes()->detach();
        }

        return redirect()->route('teachers.index')->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->matieres()->exists()) {
            return redirect()->route('teachers.index')->with('error', 'Impossible de supprimer un enseignant avec des matières associées.');
        }

        $teacher->classes()->detach();
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Enseignant supprimé avec succès.');
    }
}
