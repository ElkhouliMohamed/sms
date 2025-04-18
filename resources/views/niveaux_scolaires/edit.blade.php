@extends('layouts.app')

@section('title', 'Modifier Niveau Scolaire')

@section('content')
    <div class="w-full flex flex-col gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Modifier Niveau Scolaire</h1>
            <form action="{{ route('niveaux_scolaires.update', $niveauScolaire) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-gray-700">Nom</label>
                        <input type="text" name="nom" id="nom" class="w-full border-gray-300 rounded-lg" value="{{ old('nom', $niveauScolaire->nom) }}" required>
                        @error('nom') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" class="w-full border-gray-300 rounded-lg">{{ old('description', $niveauScolaire->description) }}</textarea>
                        @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Ordre -->
                    <div>
                        <label for="ordre" class="block text-gray-700">Ordre</label>
                        <input type="number" name="ordre" id="ordre" class="w-full border-gray-300 rounded-lg" min="0" value="{{ old('ordre', $niveauScolaire->ordre) }}" required>
                        @error('ordre') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        Mettre à Jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
