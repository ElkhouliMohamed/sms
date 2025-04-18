<!-- resources/views/matieres/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Modifier une Matière')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier la Matière</h1>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de modification -->
    <form action="{{ route('matieres.update', $matiere) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la matière</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $matiere->nom) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $matiere->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="classe_id" class="block text-sm font-medium text-gray-700">Classe</label>
            <select name="classe_id" id="classe_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                <option value="">Sélectionner une classe</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('classe_id', $matiere->classe_id) == $classe->id ? 'selected' : '' }}>{{ $classe->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="enseignant_ids" class="block text-sm font-medium text-gray-700">Enseignants</label>
            <select name="enseignant_ids[]" id="enseignant_ids" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                @foreach($enseignants as $enseignant)
                    <option value="{{ $enseignant->id }}" {{ in_array($enseignant->id, old('enseignant_ids', $selectedEnseignants)) ? 'selected' : '' }}>{{ $enseignant->nom }}</option>
                @endforeach
            </select>
            <p class="mt-1 text-sm text-gray-500">Maintenez Ctrl/Cmd pour sélectionner plusieurs enseignants.</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('matieres.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600 transition duration-200">Annuler</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Mettre à jour</button>
        </div>
    </form>
@endsection