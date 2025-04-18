@extends('layouts.app')

@section('title', 'Ajouter Classe')

@section('content')
    <div class="w-full flex flex-col gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Ajouter Nouvelle Classe</h1>
            <form action="{{ route('classes.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-gray-700">Nom</label>
                        <input type="text" name="nom" id="nom" class="w-full border-gray-300 rounded-lg" required>
                        @error('nom') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Niveau Scolaire -->
                    <div>
                        <label for="niveau_scolaire_id" class="block text-gray-700">Niveau Scolaire</label>
                        <select name="niveau_scolaire_id" id="niveau_scolaire_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Sélectionner Niveau</option>
                            @foreach ($niveaux as $niveau)
                                <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
                            @endforeach
                        </select>
                        @error('niveau_scolaire_id') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" class="w-full border-gray-300 rounded-lg"></textarea>
                        @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Enseignants -->
                    <div>
                        <label for="teacher_ids" class="block text-gray-700">Enseignants</label>
                        <select name="teacher_ids[]" id="teacher_ids" class="w-full border-gray-300 rounded-lg" multiple>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->prenom }} {{ $teacher->nom_de_famille }}</option>
                            @endforeach
                        </select>
                        @error('teacher_ids') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        Créer Classe
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection