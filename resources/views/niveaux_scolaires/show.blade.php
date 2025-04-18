@extends('layouts.app')

@section('title', 'Détails Niveau Scolaire')

@section('content')
    <div class="w-full flex flex-col gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{ $niveauScolaire->nom }}</h1>
            <div class="grid grid-cols-1 gap-4">
                <p><strong>Description:</strong> {{ $niveauScolaire->description ?? 'Aucune' }}</p>
                <p><strong>Ordre:</strong> {{ $niveauScolaire->ordre }}</p>
                <p><strong>Classes:</strong></p>
                <ul class="list-disc pl-6">
                    @foreach ($niveauScolaire->classes as $classe)
                        <li>{{ $classe->nom }} (Enseignants: {{ $classe->teachers->pluck('prenom')->join(', ') ?: 'Aucun' }})</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-6">
                <a href="{{ route('niveaux_scolaires.edit', $niveauScolaire) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Modifier
                </a>
                <form action="{{ route('niveaux_scolaires.destroy', $niveauScolaire) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700" onclick="return confirm('Êtes-vous sûr ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection