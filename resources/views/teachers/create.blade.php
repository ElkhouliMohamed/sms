@extends('layouts.app')

@section('title', 'Ajouter Enseignant')

@section('content')
    <div class="w-full flex flex-col gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Ajouter Nouvel Enseignant</h1>
            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <!-- User -->
                    <div>
                        <label for="user_id" class="block text-gray-700">Utilisateur</label>
                        <select name="user_id" id="user_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Sélectionner Utilisateur</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nom }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Prénom -->
                    <div>
                        <label for="prenom" class="block text-gray-700">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="w-full border-gray-300 rounded-lg" required>
                        @error('prenom') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Nom de Famille -->
                    <div>
                        <label for="nom_de_famille" class="block text-gray-700">Nom de Famille</label>
                        <input type="text" name="nom_de_famille" id="nom_de_famille" class="w-full border-gray-300 rounded-lg" required>
                        @error('nom_de_famille') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Téléphone -->
                    <div>
                        <label for="telephone" class="block text-gray-700">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="w-full border-gray-300 rounded-lg">
                        @error('telephone') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-lg" required>
                        @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Adresse -->
                    <div>
                        <label for="adresse" class="block text-gray-700">Adresse</label>
                        <textarea name="adresse" id="adresse" class="w-full border-gray-300 rounded-lg"></textarea>
                        @error('adresse') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <!-- Classes -->
                    <div>
                        <label for="class_ids" class="block text-gray-700">Classes</label>
                        <select name="class_ids[]" id="class_ids" class="w-full border-gray-300 rounded-lg" multiple>
                            @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                        @error('class_ids') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        Créer Enseignant
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection