<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'classe', 'parents'])->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $parents = ParentModel::select('id', DB::raw("CONCAT(nom_de_famille, ' ', prenom) as nom_complet"))->get();
        return view('students.create', compact('classes', 'parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom_de_famille' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telephone' => 'required|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:20',
            'pays' => 'nullable|string|max:255',
            'sexe' => 'nullable|string|in:masculin,feminin',
            'etat_civil' => 'nullable|string|in:celibataire,marie,divorce,veuf',
            'nationalite' => 'nullable|string|max:255',
            'numero_identite' => 'nullable|string|max:255',
            'nom_tuteur' => 'nullable|string|max:255',
            'telephone_tuteur' => 'nullable|string|max:20',
            'adresse_tuteur' => 'nullable|string|max:255',
            'date_de_naissance' => 'required|date',
            'classe_id' => 'required|exists:classes,id',
            'parent_ids' => 'nullable|array',
            'parent_ids.*' => 'exists:parents,id',
        ]);

        $user = User::create([
            'name' => $validated['prenom'] . ' ' . $validated['nom_de_famille'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'email_verified_at' => now(),
        ]);

        $user->assignRole('student');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('student_images', 'public');
        }

        $validated['utilisateur_id'] = $user->id;
        $student = Student::create($validated);

        if ($request->filled('parent_ids')) {
            $student->parents()->sync($request->parent_ids);
        }

        return redirect()->route('students.index')->with('success', 'Élève créé avec succès.');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'classe', 'parents', 'absences', 'grades', 'payments', 'transports']);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = ClassModel::all();
        $parents = ParentModel::select('id', DB::raw("CONCAT(nom_de_famille, ' ', prenom) as nom_complet"))->get();
        return view('students.edit', compact('student', 'classes', 'parents'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom_de_famille' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telephone' => 'required|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:20',
            'pays' => 'nullable|string|max:255',
            'sexe' => 'nullable|string|in:masculin,feminin',
            'etat_civil' => 'nullable|string|in:celibataire,marie,divorce,veuf',
            'nationalite' => 'nullable|string|max:255',
            'numero_identite' => 'nullable|string|max:255',
            'nom_tuteur' => 'nullable|string|max:255',
            'telephone_tuteur' => 'nullable|string|max:20',
            'adresse_tuteur' => 'nullable|string|max:255',
            'date_de_naissance' => 'required|date',
            'classe_id' => 'required|exists:classes,id',
            'parent_ids' => 'nullable|array',
            'parent_ids.*' => 'exists:parents,id',
        ]);

        $userData = [
            'name' => $validated['prenom'] . ' ' . $validated['nom_de_famille'],
            'email' => $validated['email'],
        ];
        if ($request->filled('password')) {
            $userData['password'] = $validated['password'];
        }
        $student->user->update($userData);

        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            $validated['image'] = $request->file('image')->store('student_images', 'public');
        }

        $student->update($validated);

        if ($request->filled('parent_ids')) {
            $student->parents()->sync($request->parent_ids);
        } else {
            $student->parents()->detach();
        }

        return redirect()->route('students.index')->with('success', 'Élève mis à jour avec succès.');
    }

    public function destroy(Student $student)
    {
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }
        $student->parents()->detach();
        $student->user->delete();
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Élève supprimé avec succès.');
    }
}
